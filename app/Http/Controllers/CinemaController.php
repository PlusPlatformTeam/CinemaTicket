<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use App\Models\Movie;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function Index()
    {
        $cinemas = Cinema::with('options')->get()->toArray();
        return view('user.cinemas', [
            'cinemas' => $cinemas,
            'cities' => City::all(),
            'lastMovies' => Movie::with('category')->latest()->take(8)->get(),
            'topMovies' => Movie::orderByDesc('sale')->take(5)->get()
        ]);
    }

}
