<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Comment;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function GetAll(Request $request)
    {
        $movies = Movie::all(['slug', 'title', 'score', 'director', 'main_banner', 'sale']);

        return view('user.movies', [
            'movies' => $movies
        ]);
    }
    public function ShowMovie(Request $request)
    {

        $movie = Movie::with('category')
            ->with('characters')
            ->where('slug', $request->slug)
            ->firstOrFail();

        $top_movies = Movie::orderByDesc('sale')->take(5)->get();
        $cinemas = Cinema::get()->toArray();

        $comments = Comment::leftJoin('users', 'comments.user_id', '=', 'users.id')
        ->where('comments.movie_id', $movie->id)
        ->select('comments.*', 'users.*')
        ->get()
        ->toArray();

        return view('user.movie', [
            'movie' => $movie,
            'cinemas' => $cinemas,
            'topMovies' => $top_movies,
            'comments'=>$comments,
        ]);
    }
}