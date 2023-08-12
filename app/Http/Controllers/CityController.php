<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function GetAll()
    {
        $cities = City::all(['id', 'title']);
        return response(['cities' => $cities], 200);
    }

    public function Show()
    {
        return view('admin.manage_Cities', [
            'cities' => City::paginate(2),
            'provinces' => Province::all(),
        ]);
    }

    public function Delete(Request $request)
    {
        $request->validate([
            'city' => 'required|exists:categories,id',
        ]);

        $city = City::find($request->city);

        if ($city) {
            $city->delete();

            return response()->json([
                'message' => 'شهر با موفقیت پاک شد',
            ]);
        } else {
            return response()->json([
                'message' => 'شهر یافت نشد',
            ], 404);
        }
    }

    public function Create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:cities,title',
            'province' => 'required|exists:provinces,id'
        ]);

        $city = City::create(['title' => $request->title, 'province_id' => $request->province]);

        if ($city) {
            return redirect()->back()->with(
                'success' , 'شهر با موفقیت ایجاد شد',
            );
        } else {
            return response()->json([
                'message' => 'خطا رخ داده است',
            ], 500);
        }
    }

}
