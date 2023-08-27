<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Factor;
use App\Models\Province;
use App\Models\Sans;
use App\Models\Ticket;

class AdminController extends Controller
{
    public function Index()
    {
        return view('admin.dashboard', ['admin' => auth()->user()]);
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
