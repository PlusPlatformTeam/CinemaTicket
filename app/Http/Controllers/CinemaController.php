<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Option;
use App\Models\Sans;

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
            ->get()->toArray();

        for ($i = 0; $i < 4; $i++) {
            $timestamp    = strtotime("+$i days");
            $date         = $jdate->date("l j F", $timestamp, true, true, 'Asia/Tehran');
            $daysOfWeek[] = explode(' ', $date);
        }
        return view('user.cinema', [
            'cinema'     => $cinema,
            'topMovies'  => Movie::orderByDesc('sale')->take(5)->get(),
            'options'    => Option::all(),
            'sans'       => $sans,
            'lastMovies' => Movie::all(),
            'daysOfWeek' => $daysOfWeek
        ]);
    }

    public function Sort(Request $request)
    {
        $request->validate([
            'sortValue' => 'required|string|in:all,top,near'
        ]);

        if ($request->sortValue === 'all') {
            return response([
                'cinemas' => Cinema::with('options')->get()
            ], 200);
        } elseif ($request->sortValue === 'top') {
            return response([
                'cinemas' => Cinema::with('options')->orderByDesc('score')->get()
            ], 200);
        } else {
        }
    }
}
