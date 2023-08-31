<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Cinema;
use App\Models\City;
use App\Models\Comment;
use App\Models\Factor;
use App\Models\Movie;
use App\Models\Province;
use App\Models\Sans;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.dashboard', [
            'admin' => auth()->user(),
            'cities'=> City::all(['id', 'title']),
            'cinemas' => Cinema::all(['id', 'title']),
            'movies' => Movie::all(['id', 'title']),
            'cinemasCount' => convertDigitsToFarsi(number_format(Cinema::all()->count())),
            'moviesCount' => convertDigitsToFarsi(number_format(Movie::all()->count())),
            'actorsCount' => convertDigitsToFarsi(number_format(Character::all()->count())),
            'commentsCount' => convertDigitsToFarsi(number_format(Comment::all()->count()))
        ]);
    }

    public function Provinces()
    {
        return view('admin.manage_provinces', ['provinces' => Province::paginate(2)]);
    }

    public function Comments()
    {
        return view('admin.manage_comments', ['comments' => Comment::paginate(2)]);
    }

    public function Factors()
    {
        return view('admin.manage_factors', ['factors' => Factor::paginate(2)]);
    }

    public function Sans()
    {
        return view('admin.manage_sans', ['sans' => Sans::paginate(2)]);
    }

    public function Tickets()
    {
        return view('admin.manage_tickets', ['tickets' => Ticket::paginate(2)]);
    }
}
