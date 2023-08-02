<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Movie;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

public function show(Character $character){

    $date = new \jDateTime(true, true, 'Asia/Tehran');
    $actor = Character::with('city')->where("id",$character->id)->get()->first();
    $actor['birthday'] = $date->date("j F Y ", strtotime($actor['birthday']));
    $actorMovies = Movie::whereHas('characters', function ($query) use ($character) {
        $query->where('characters.id', $character->id);
    })->get();

    return view('user.character', [

        'actor'        => $actor,
        'actorMovies'  => $actorMovies,

    ]);
}


}
