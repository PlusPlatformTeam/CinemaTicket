<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $last_movies = Movie::with('category')->latest()->take(8)->get();
        $top_movies  = Movie::orderByDesc('sale')->take(5)->get();

        $cities = City::get();

        return view('user.home', [
            'lastMovies' => $last_movies ,
            'cities' => $cities,
            'topMovies' => $top_movies
        ]);
    }
}
