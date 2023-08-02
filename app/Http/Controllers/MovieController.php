<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Comment;
use App\Models\Score;
use App\Rules\MovieExists;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function GetAll(Request $request)
    {
        $movies = Movie::get();

        return view('user.movies', [
            'movies' => $movies
        ]);
    }
    public function ShowMovie(Request $request) //TODO FIX use modelBinding key
    {
        $date = new \jDateTime(true, true, 'Asia/Tehran');
        $movie = Movie::with('category') //TODO FIX 
            ->with('characters')
            ->where('slug', $request->slug)
            ->firstOrFail();

        $top_movies = Movie::orderByDesc('sale')->take(5)->get();
        $cinemas    = Cinema::get();

        $comments = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.movie_id', $movie->id)
        ->where('comments.state', Comment::ACCEPT) 
        ->select('comments.*', 'users.*')
        ->get()
        ->toArray();
    
    $commentCount = count($comments);
    
    foreach ($comments as &$comment) { 
        $comment['created_at'] = $date->date("j F Y ", strtotime($comment['created_at']));
    }
        $userScore = Score::where([
                            ['user_id', auth()->id()],
                            ['scorable_id', $movie->id],
                            ['scorable_type', 'App\Models\Movie']
                        ])->first();

        return view('user.movie', [
            'movie'     => $movie,
            'cinemas'   => $cinemas,
            'topMovies' => $top_movies,
            'comments'  => $comments,
            'commentCount' =>$commentCount,
            'userScore' => $userScore->score ?? null
        ]);
    }
    public function Score(Request $request)
    {
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

        if ($score)
        {
            return response(['message' => 'امتیاز شما با موفقیت ثبت شد', 'totalScore' => convertDigitsToFarsi('5 / ' . $movie->score)], 200);
        }
        return response(['message' => 'خطا رخ  داده است لطفا بعدا تلاش کنید'], 500);

    }
}