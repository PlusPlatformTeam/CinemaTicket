<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\City;
use App\Models\Movie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $last_movies = Movie::with('category')->latest()->take(8)->get();
        $top_movies  = Movie::orderByDesc('sale')->take(5)->get();

        return view('user.home', [
            'lastMovies' => $last_movies ,
            'topMovies' => $top_movies
        ]);
    }

    public function Search(Request $request)
    {
        if (is_null($request->value))
        {
            $topMovies  = Movie::orderByDesc('score')->take(3)->select('slug', 'title', 'main_banner')->get();
            $topCinemas = Cinema::orderByDesc('score')->take(3)->select('id', 'title', 'poster')->get();

            return response([
                'topMovies'  => $topMovies,
                'topCinemas' => $topCinemas
            ], 200);
        }
        
        $topCinemas = Cinema::where('title', 'LIKE', '%' . $request->value . '%')->take(3)->select('id', 'title', 'poster')->get();
        $topMovies  = Movie::where('title', 'LIKE', '%' . $request->value . '%')->take(3)->select('slug', 'title', 'main_banner')->get();
        
        return response([
            'topMovies'  => $topMovies,
            'topCinemas' => $topCinemas
        ], 200);
    }
}
