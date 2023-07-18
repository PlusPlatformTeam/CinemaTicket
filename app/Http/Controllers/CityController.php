<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function GetAll()
    {
        $cities = City::all(['id', 'title']);
        return response(['cities' => $cities], 200);
    }
}
