<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Comment;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function ShowMovie(Request $request)
    {
        $last_movies = Movie::with('category')->latest()->take(8)->get();

        $movie = Movie::with('category')
            ->with('characters')
            ->where('slug', $request->slug)
            ->firstOrFail();

        $top_movies = Movie::orderByDesc('sale')->take(5)->get();
        $cities = City::get();
        $cinemas = Cinema::get()->toArray();

        $comments = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.movie_id', $movie->id)
        ->select('comments.*', 'users.*')
        ->get()
        ->toArray();

        return view('user.movie', [
            'lastMovies' => $last_movies,
            'movie' => $movie,
            'cinemas' => $cinemas,
            'cities' => $cities,
            'topMovies' => $top_movies,
            'comments'=>$comments,
        ]);
    }
}