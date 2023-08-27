<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function Show()
    {
        return view('admin.manage_provinces', ['provinces' => Province::paginate(2)]);
    }

    public function Create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:provinces,title',
        ]);

        $province = Province::create(['title' => $request->title]);

        if ($province) {
            return redirect()->back()->with(
                'success' , 'استان با موفقیت ایجاد شد',
            );
        } else {
            return response()->json([
                'message' => 'خطا رخ داده است',
            ], 500);
        }
    }

    public function Delete(Request $request)
    {
        $province = Province::find($request->id);

        if ($province){
            $province->delete();

            return redirect()->back()->with(
                'success' , 'استان  باموفقیت پاک  شد ',
            );
        }
        return redirect()->back()->with(
            'error' , 'استان  یافت  نشد',
        );
    }
}
