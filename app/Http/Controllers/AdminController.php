<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Character;
use App\Models\Cinema;
use App\Models\City;
use App\Models\Comment;
use App\Models\Factor;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Option;
use App\Models\Province;
use App\Models\Sans;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.dashboard', ['admin' => auth()->user()]);
    }

    public function Comments()
    {
        return view('admin.manage_comments', ['comments' => Comment::paginate(3)]);
    }

    public function Factors()
    {
        return view('admin.manage_factors', ['factors' => Factor::paginate(4)]);
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
