<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
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
    public function Index()
    {
        $cinemas = Cinema::with('options')->get();
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
            ->get();

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
            $timestamp    = strtotime("+$i days");
            $date         = $jdate->date("l j F", $timestamp, true, true, 'Asia/Tehran');
            $daysOfWeek[] = explode(' ', $date);
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

        if ($request->sortValue === 'all') 
        {
            return response([
                'cinemas' => Cinema::with(['scores' => function ($query) 
                {
                    $query->select('scorable_id', DB::raw('AVG(score) as val'))
                        ->groupBy('scorable_id');
                }, 'options'])->get()
            ], 200);
        } 
        elseif ($request->sortValue === 'top') 
        {
            return response([
                'cinemas' => Cinema::with(['scores' => function ($query) 
                {
                    $query->select('scorable_id', DB::raw('AVG(score) as val'))
                        ->groupBy('scorable_id')
                        ->orderByRaw('AVG(score) DESC');
                }, 'options'])
                    ->get()
            ], 200);
        } 
        else 
        {
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

        if (!$score) {
            return response(['message' => 'امتیاز شما با موفقیت ثبت شد', 'totalScore' => convertDigitsToFarsi('5 / ' . $cinema->score)], 200);
        }
        return response(['message' => 'خطا رخ  داده است لطفا بعدا تلاش کنید'], 500);
    }
}
