<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\City;
use App\Models\Movie;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

    public function Index(Character $character)
    {

        $date = new \jDateTime(true, true, 'Asia/Tehran');
        $actor = Character::with('city')->where("id", $character->id)->get()->first();
        $actor['birthday'] = $date->date("j F Y ", strtotime($actor['birthday']));
        $actorMovies = Movie::whereHas('characters', function ($query) use ($character) {
            $query->where('characters.id', $character->id);
        })->get();

        return view('user.character', [
            'actor'        => $actor,
            'actorMovies'  => $actorMovies,
        ]);
    }

    public function Show()
    {
        return view('admin.manage_characters', [
            'characters' => Character::paginate(2),
            'cities'     => City::all(['id', 'title'])
        ]);
    }

    public function Create(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|unique:characters,name',
            'avatar'      => 'required|file|image|mimes:png,jpg',
            'birthday'    => 'required',
            'city'        => 'required|exists:cities,id',
            'description' => 'required'
        ]);

        $avatar      = $request->file('avatar');
        $avatar_name = getRandomFileName().'.'.$avatar->getClientOriginalExtension();
        $avatar_path = $avatar->move(public_path('actors'), $avatar_name);

        $character = Character::create([
            'name' => $request->name,
            'avatar' => "actors/{$avatar_name}",
            'birthday' => $request->birthday,
            'city_id' => $request->city,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', "بازیگر {$character->name} با موفقیت ایجاد شد");

    }

    public function Delete(Request $request)
    {
        $request->validate([
            'character' => 'required|exists:characters,id',
        ]);

        $characterId = $request->character;

        $character = Character::find($characterId);

        if ($character) {
            $character->delete();

            return response()->json([
                'message' => 'بازیگر با موفقیت پاک شد',
            ]);
        } else {
            return response()->json([
                'message' => 'بازیگر یافت نشد',
            ], 404);
        }
    }

    public function Update(Request $request)
    {
        $request->validate([
            'character'   => 'required|exists:characters,id',
            'name'        => 'required|string',
            'birthday'    => 'required',
            'city'        => 'required|exists:cities,id',
            'description' => 'required'
        ]);

        $character = Character::find($request->character);

        $character->name = $request->name;
        $character->birthday = $request->birthday;
        $character->city_id = $request->city;
        $character->description = $request->description;

        $character->save();
        
        return redirect()->back()->with('success', "بازیگر {$character->name} با موفقیت ویرایش شد");

    }
}