<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Comment;
use App\Models\Sans;
use App\Models\Score;
use App\Rules\MovieExists;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function GetAll(Request $request)
    {
        $movies = Movie::get();

        return view('user.movies', [
            'movies' => $movies
        ]);
    }
    public function ShowMovie(Movie $movie)
    {

        $selectedCityId = isset($_COOKIE['selectedCityId']) ? $_COOKIE['selectedCityId']:null;

        $date = new \jDateTime(true, true, 'Asia/Tehran');

        $dateString = $movie['created_at'];
        $formattedDateString = $date->date("Y", strtotime($dateString));

        $top_movies = Movie::orderByDesc('sale')->take(5)->get();
        $daysOfWeek = [];
        $jdate      = new \jDateTime(true, true, 'Asia/Tehran');
        $timezone   = new \DateTimeZone('+0330');
        $start      = new \DateTime('now', $timezone);
        $start      = $start->format('Y-m-d H:i:s');
        $end        = date('Y-m-d') . ' 23:59:59';
        $allSans    = Sans::with(['cinema', 'hall'])
                ->where('movie_id', $movie->id)
                ->whereBetween('started_at', [$start, $end])
                ->select('sans.*')
                ->get()
                ->toArray();

        if ($selectedCityId) {
            $sans = Sans::with(['cinema', 'hall'])
                 ->join('cinemas', 'sans.cinema_id', '=', 'cinemas.id')
                ->where('movie_id', $movie->id)
                ->whereBetween('started_at', [$start, $end])
                ->where('cinemas.city_id', $selectedCityId)
                ->select('sans.*')
                ->get()
                ->toArray();

            if (collect($sans)->isEmpty()) {
                $sans = $allSans;
            }
        } else {
            $sans = $allSans;
        }

        $comments = Comment::with('user')
            ->where('movie_id', $movie->id)
            ->where('state', Comment::ACCEPT)
            ->get();

        for ($i = 0; $i < 4; $i++)
        {
            $timestamp    = strtotime("+$i days");
            $date         = $jdate->date("l j F", $timestamp, true, true, 'Asia/Tehran');
            $daysOfWeek[] = explode(' ', $date);
            $daysOfWeek[$i]['time'] = date('Y-m-d', $timestamp);

        }

        $commentCount = count($comments);

        foreach ($comments as &$comment)
        {
            $comment['created_at1'] = $jdate->date("j F Y ", strtotime($comment['created_at']));
        }

        $userScore = Score::where([
                            ['user_id', auth()->id()],
                            ['scorable_id', $movie->id],
                            ['scorable_type', 'App\Models\Movie']
                        ])->first();

        return view('user.movie', [
            'movie'     => $movie,
            'sans'      => $sans,
            'topMovies' => $top_movies,
            'comments'  => $comments,
            'userScore' => $userScore->score ?? null,
            'daysOfWeek' => $daysOfWeek,
            'commentCount' =>$commentCount,
            'formattedDateString' => $formattedDateString
        ]);
    }
    public function Score(Request $request)
    {
        try{
            $request->validate([
                'movie_id' => ['required', new MovieExists],
                'score'    => 'required|integer|min:1|max:5'
            ]);

            $user  = auth()->user();
            $movie = Movie::find($request->movie_id);
            $score = $user->scores()->updateOrCreate(
                [
                    'user_id' => $user->id,
                    'scorable_type' => 'App\Models\Movie',
                    'scorable_id' => $movie->id,
                ],
                [
                    'score' => $request->score,
                    'scorable_type' => 'App\Models\Movie',
                    'scorable_id' => $movie->id,
                ]
            );

            $movie->score = $movie->averageScore();
            $movie->save();
            if ($score)
            {
                return response(['message' => 'امتیاز شما با موفقیت ثبت شد', 'totalScore' => convertDigitsToFarsi('5 / ' . $movie->score)], 200);
            }
        }
        catch(Exception $ex)
        {
            Log::error($ex->getMessage());
        }
        return response(['message' => 'خطا رخ  داده است لطفا بعدا تلاش کنید'], 500);

    }

    public function ManageMovies()
    {
        return view('admin.manage_movies', [
            'movies' => Movie::paginate(2),
            'categories' => Category::all(),
            'states' => Movie::STATES
        ]);
    }

    public function Delete(Request $request)
    {
        $request->validate([
            'movie' => 'required|exists:movies,id',
        ]);

        $movieId = $request->movie;

        $movie = Movie::find($movieId);

        if ($movie) {
            $movie->delete();

            return response()->json([
                'message' => 'فیلم با موفقیت پاک شد',
            ]);
        } else {
            return response()->json([
                'message' => 'فیلم یافت نشد',
            ], 404);
        }
    }

    public function Create(Request $request)
    {
        try{
            $request->validate([
                'title'       => 'required|string',
                'category'    => 'required|exists:categories,id',
                'duration'    => 'required|min:30|max:180|numeric',
                'info'        => 'required|string',
                'director'    => 'required|string',
                'poster'      => 'required|file',
                'banner'      => 'required|file',
            ]);

            $poster = $request->file('poster');
            $banner = $request->file('banner');

            $poster_name = getRandomFileName().'poster.'.$poster->getClientOriginalExtension();
            $banner_name = getRandomFileName().'banner.'.$banner->getClientOriginalExtension();

            $slug = Str::random(8);
            $directory = public_path("movies/{$slug}");

            if (!File::exists($directory)) {
                File::makeDirectory($directory, 0777, true);
            }

            $poster_path = $poster->move($directory, $poster_name);
            $banner_path = $banner->move($directory, $banner_name);

            $movie = Movie::create([
                'title'       => $request->title,
                'slug'        => $slug,
                'category_id' => $request->category,
                'director'    => $request->director,
                'info'        => $request->info,
                'duration'    => $request->duration,
                'main_banner' => "movies/{$slug}/{$banner_name}",
                'second_banner'=> "movies/{$slug}/{$poster_name}"
            ]);

            return redirect()->back()->with('success', "فیلم {$movie->title} با موفقیت ایجاد شد");
        }
        catch(Exception $ex)
        {
            dd($ex);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'movie'       => 'required|exists:movies,id',
            'title'       => 'required|string',
            'category'    => 'required|exists:categories,id',
            'duration'    => 'required|min:30|max:180|numeric',
            'info'        => 'required|string',
            'director'    => 'required|string',
            'state'       => ['required', 'in:' . implode(',', Movie::STATES)]
        ]);

        $movie = Movie::find($request->movie);
        if (!$movie) {
            return redirect()->back()->with('error', 'فیلم یافت نشد');
        }

        $movie->title           = $request->title;
        $movie->category_id     = $request->category;
        $movie->duration        = $request->duration;
        $movie->info            = $request->info;
        $movie->director        = $request->director;
        $movie->state           = $request->state;

        $movie->save();

        return redirect()->back()->with('success', "فیلم {$movie->title} با موفقیت آپدیت شد");
    }
}
