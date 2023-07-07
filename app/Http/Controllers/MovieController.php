<?php

namespace App\Http\Controllers;



namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{


    public function index(Request $request)
    {
        $last_movies = Movie::with('category')->latest()->take(8)->get();

        $movie = Movie::with('category')
            ->with('characters')
            ->where('slug', $request->slug)
            ->firstOrFail();

        $top_movies = Movie::orderByDesc('sale')->take(5)->get();
        $cities = City::get();
        return view('user.movie', [
            'lastMovies' => $last_movies,
            'movie' => $movie,
            'cities' => $cities,
            'topMovies' => $top_movies,

        ]);
    }



}
