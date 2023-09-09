<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use App\Models\Score;
use App\Rules\CinemaExists;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Option;
use App\Models\Sans;
use App\Models\Comment;

use Illuminate\Support\Facades\DB;

class CinemaController extends Controller
{
    public function index(Request $request)
    {
        $selectedCityId = isset($_COOKIE['selectedCityId']) ? $_COOKIE['selectedCityId'] :null;
    
        if ($selectedCityId) {
            $cinemas = Cinema::with('options')
                ->where('city_id', $selectedCityId)
                ->get();

    
            if ($cinemas->isEmpty()) {
                $cinemas = Cinema::with('options')->get();
            }
        } else {
            $cinemas = Cinema::with('options')->get();
        }
    
        return view('user.cinemas', [
            'cinemas'    => $cinemas,
            'topMovies'  => Movie::orderByDesc('sale')->take(5)->get(),
            'options'    => Option::all()
        ]);
    }
    //        $date = new \jDateTime(true, true, 'Asia/Tehran');

    public function ShowCinema(Cinema $cinema)
    {
        $daysOfWeek = [];
        $jdate      = new \jDateTime(true, true, 'Asia/Tehran');
        $timezone   = new \DateTimeZone('+0330');
        $start      = new \DateTime('now', $timezone);
        $start      = $start->format('Y-m-d H:i:s');
        $end        = date('Y-m-d') . ' 23:59:59';
        $sans       = Sans::with(['cinema', 'movie.characters', 'movie.category', 'hall'])
            ->where('cinema_id', $cinema->id)
            ->whereBetween('started_at', [$start, $end])
            ->get()->toArray();

        $comments = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id')
            ->where('comments.cinema_id', $cinema->id)
            ->where('comments.state', Comment::ACCEPT)
            ->select('comments.*', 'users.*')
            ->get()
            ->toArray();

        $commentCount = count($comments);

        foreach ($comments as &$comment) {
            $comment['created_at'] = $jdate->date("j F Y ", strtotime($comment['created_at']));
        }

        for ($i = 0; $i < 4; $i++) {
            $timestamp              = strtotime("+$i days");
            $date                   = $jdate->date("l j F", $timestamp, true, true, 'Asia/Tehran');
            $daysOfWeek[$i]         = explode(' ', $date);
            $daysOfWeek[$i]['time'] = date('Y-m-d', $timestamp);
        }

        $userScore = Score::where([
            ['user_id', auth()->id()],
            ['scorable_id', $cinema->id],
            ['scorable_type', 'App\Models\Cinema']
        ])->first();


        return view('user.cinema', [
            'cinema'        => $cinema,
            'topMovies'     => Movie::orderByDesc('sale')->take(5)->get(),
            'options'       => Option::all(),
            'sans'          => $sans,
            'comments'      => $comments,
            'commentCount'  => $commentCount,
            'lastMovies'    => Movie::all(),
            'daysOfWeek'    => $daysOfWeek,
            'userScore'     => $userScore->score ?? -1
        ]);
    }

    public function Sort(Request $request)
    {
        $request->validate([
            'sortValue' => 'required|string|in:all,top,near'
        ]);

        if ($request->sortValue === 'all') {
            return response([
                'cinemas' => Cinema::with(['options'])->get()
            ], 200);
        } elseif ($request->sortValue === 'top') {
            return response([
                'cinemas' => Cinema::with(['options'])
                    ->orderByDesc('score')->get()
            ], 200);
        } else {
        }
    }

    public function Score(Request $request)
    {
        $request->validate([
            'cinema_id' => ['required', new CinemaExists],
            'score'    => 'required|integer|min:1|max:5'
        ]);

        $user   = auth()->user();
        $cinema = Cinema::find($request->cinema_id);
        $score  = $user->scores()->updateOrCreate(
            [
                'user_id' => $user->id,
                'scorable_type' => 'App\Models\Cinema',
                'scorable_id' => $cinema->id,
            ],
            [
                'score' => $request->score,
                'scorable_type' => 'App\Models\Cinema',
                'scorable_id' => $cinema->id,
            ]
        );

        $cinema->score = $cinema->averageScore();
        $cinema->save();

        if ($score) {
            return response(['message' => 'امتیاز شما با موفقیت ثبت شد', 'totalScore' => convertDigitsToFarsi('5 / ' . $cinema->score)], 200);
        }
        return response(['message' => 'خطا رخ  داده است لطفا بعدا تلاش کنید'], 500);
    }

    public function ManageCinemas()
    {
        return view('admin.manage_cinemas', [
            'cinemas' => Cinema::with('options')->paginate(2),
            'cities'  => City::all(['id', 'title']),
            'options' => Option::all(['id', 'title', 'icon'])
        ]);
    }

    public function Delete(Request $request)
    {
        $request->validate([
            'cinema' => 'required|exists:cinemas,id',
        ]);

        $cinemaId = $request->cinema;

        $cinema = Cinema::find($cinemaId);

        if ($cinema) {
            $cinema->delete();

            return response()->json([
                'message' => 'سینما با موفقیت پاک شد',
            ]);
        } else {
            return response()->json([
                'message' => 'سینما یافت نشد',
            ], 404);
        }
    }

    public function Create(Request $request)
    {
        $request->validate([
            'title'       => 'required|string',
            'city'        => 'required|exists:cities,id',
            'phone'       => 'required|string',
            'address'     => 'required|string',
            'description' => 'required|string',
            'poster'      => 'required|file',
            'banner'      => 'required|file',
            'location'    => 'required|regex:/^(\d{1,3}\.\d+),(\d{1,3}\.\d+)$/',
        ]);

        $poster = $request->file('poster');
        $banner = $request->file('banner');

        $poster_name = getRandomFileName().'poster.'.$poster->getClientOriginalExtension();
        $banner_name = getRandomFileName().'banner.'.$banner->getClientOriginalExtension();
        $poster_path = $poster->move(public_path('cinemas'), $poster_name);
        $banner_path = $banner->move(public_path('cinemas'), $banner_name);

        list($lat, $lng) = explode(',', $request->location);
        $location        = json_encode([
            'lat' => $lat,
            'lng' => $lng,
        ]);

        $cinema = Cinema::create([
            'title'       => $request->title,
            'city_id'     => $request->city,
            'phone'       => $request->phone,
            'address'     => $request->address,
            'description' => $request->description,
            'poster'      => "cinemas/{$poster_name}",
            'banner'      => "cinemas/{$banner_name}",
            'location'    => $location
        ]);
        
        return redirect()->back()->with('success', "سینما {$cinema->title} با موفقیت ایجاد شد");
    }

    public function Update(Request $request)
    {
        $request->validate([
            'cinema'      => 'required|exists:cinemas,id',
            'title'       => 'required|string',
            'city'        => 'required|exists:cities,id',
            'phone'       => 'required|numeric',
            'address'     => 'required|string',
            'description' => 'required|string',
            'option.*'    => 'nullable|exists:options,id'
        ]);

        $cinema = Cinema::find($request->cinema);
        if (!$cinema) {
            return redirect()->back()->with('error', 'سینما یافت نشد');
        }
    
        $cinema->title       = $request->title;
        $cinema->city_id     = $request->city;
        $cinema->phone       = $request->phone;
        $cinema->address     = $request->address;
        $cinema->description = $request->description;
    
        $cinema->save();
    
        $cinema->options()->sync($request->option);
    
        return redirect()->back()->with('success', "سینما {$cinema->title} با موفقیت آپدیت شد");
    }

    public function getCinemaByCity(Request $request)
    {
        $city_id = $request->city;
        return response(['cinemas' => Cinema::all()->where('city_id', '=', $city_id)], 200);
    }
}
