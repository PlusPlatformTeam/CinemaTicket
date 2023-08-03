<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Comment;
use App\Models\Sans;
use App\Models\Score;
use App\Rules\MovieExists;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $sans       = Sans::with(['cinema', 'hall'])
            ->where('movie_id', $movie->id)
            ->whereBetween('started_at', [$start, $end])
            ->select('sans.*')
            ->get()->toArray();

        $comments = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id') //TODO Replace with relations
        ->where('comments.movie_id', $movie->id)
        ->where('comments.state', Comment::ACCEPT) 
        ->select('comments.*', 'users.*')
        ->get()
        ->toArray();
    
        for ($i = 0; $i < 4; $i++) 
        {
            $timestamp    = strtotime("+$i days");
            $date         = $jdate->date("l j F", $timestamp, true, true, 'Asia/Tehran');
            $daysOfWeek[] = explode(' ', $date);
        }

        $commentCount = count($comments);
        
        foreach ($comments as &$comment) 
        { 
            $comment['created_at'] = $jdate->date("j F Y ", strtotime($comment['created_at']));
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
}