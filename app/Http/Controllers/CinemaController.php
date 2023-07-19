<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Option;

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

    public function ShowCinema(Cinema $cinema)
    {
        return view('user.cinema', [
            'cinema'     => $cinema,
            'topMovies'  => Movie::orderByDesc('sale')->take(5)->get(),
            'options'    => Option::all()
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
                'cinemas' => Cinema::with('options')->get()
            ], 200);
        }
        elseif ($request->sortValue === 'top')
        {
            return response([
                'cinemas' => Cinema::with('options')->orderByDesc('score')->get()
            ], 200);
        }
        else
        {

        }

    }
}
