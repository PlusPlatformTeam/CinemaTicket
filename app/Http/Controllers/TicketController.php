<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function Show(Request $request)
    {
        return view('admin.manage_tickets', [
            'tickets' => Ticket::paginate(4)
        ]);
    }
}
