<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\City;
use App\Models\Movie;
use App\Models\VideoCharacter;
use Illuminate\Broadcasting\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{

    public function Index(Character $character)
    {
        $date                = new \jDateTime(true, true, 'Asia/Tehran');
        $character->birthday = $date->date("j F Y", strtotime($character->birthday));

        $actorMovies = Movie::whereHas('characters', function ($query) use ($character) {
            $query->where('characters.id', $character->id);
        })->get();

        return view('user.character', [
            'actor'        => $character,
            'actorMovies'  => $actorMovies,
        ]);
    }

    public function Show()
    {
        $characters = Character::paginate(2);
        $jdate      = new \jDateTime(true, true, 'Asia/Tehran');
        foreach ($characters as &$character)
        {
            $character['birthday'] = $jdate->date('Y-m-d', strtotime($character['birthday']), false);
        }

        return view('admin.manage_characters', [
            'characters' => $characters,
            'cities'     => City::all(['id', 'title']),
            'movies'     => Movie::all(['id', 'title'])
        ]);
    }

    public function Create(Request $request)
    {
        DB::beginTransaction();
        try {
            $jDate = new \jDateTime(true, true, "Asia/Tehran");

            $request->validate([
                'name'        => 'required|string|unique:characters,name',
                'avatar'      => 'required|file|image|mimes:png,jpg',
                'birthday'    => 'required',
                'city'        => 'required|exists:cities,id',
                'description' => 'required',
                'movie'       => 'nullable',
                'movie.*'     => 'exists:movies,id'
            ]);

            $avatar      = $request->file('avatar');
            $avatar_name = getRandomFileName().'.'.$avatar->getClientOriginalExtension();
            $avatar_path = $avatar->move(public_path('actors'), $avatar_name);

            list($jalaliYear, $jalaliMonth, $jalaliDay) = explode('/', $request->birthday);
            $gregorianDate = $jDate->toGregorian($jalaliYear, $jalaliMonth, $jalaliDay);

            $character = Character::create([
                'name' => $request->name,
                'avatar' => "/actors/{$avatar_name}",
                'birthday' => "{$gregorianDate[0]}-{$gregorianDate[1]}-{$gregorianDate[2]}",
                'city_id' => $request->city,
                'description' => $request->description,
            ]);

            if (!empty($request->movie))
            {
                foreach ($request->movie as $movie)
                {
                    VideoCharacter::create([
                        'movie_id' => $movie,
                        'character_id' => $character->id
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', "بازیگر {$character->name} با موفقیت ایجاد شد");
        }

        catch (\Exception $exception){
            DB::rollBack();
            dd($exception);
        }
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
        $jDate = new \jDateTime(true, true, "Asia/Tehran");

        $request->validate([
            'character'   => 'required|exists:characters,id',
            'name'        => 'required|string',
            'birthday'    => 'required',
            'city'        => 'required|exists:cities,id',
            'description' => 'required'
        ]);

        list($jalaliYear, $jalaliMonth, $jalaliDay) = explode('/', $request->birthday);
        $gregorianDate = $jDate->toGregorian($jalaliYear, $jalaliMonth, $jalaliDay);

        $character = Character::find($request->character);

        $character->name = $request->name;
        $character->birthday = "{$gregorianDate[0]}-{$gregorianDate[1]}-{$gregorianDate[2]}";
        $character->city_id = $request->city;
        $character->description = $request->description;

        $character->save();

        return redirect()->back()->with('success', "بازیگر {$character->name} با موفقیت ویرایش شد");

    }
}
