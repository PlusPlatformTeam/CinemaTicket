<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $last_movies = Movie::with('category')->latest()->take(4)->get();
        $cities = City::get();

        return view('user.home', [
            'lastMovies' => $last_movies ,
            'cities' => $cities,
        ]);
    }
}
