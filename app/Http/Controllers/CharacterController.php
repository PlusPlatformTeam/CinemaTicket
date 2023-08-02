<?php

namespace App\Http\Controllers;
use App\Models\Character;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

public function show(Character $character){


    dd($character);



    return view('user.character', [
    ]);

}


}
