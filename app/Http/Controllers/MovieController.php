<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function Index(Request $request)
    {
        dd($request->toArray());
    }
}
