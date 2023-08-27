<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Hall;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function Show()
    {
        return view('admin.manage_halls', [
            'halls' => Hall::paginate(2),
            'cinemas' => Cinema::all(['id', 'title'])
        ]);
    }
    
    public function Create(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string',
            'cinema' => 'required|exists:cinemas,id',
            'capacity' => 'required|numeric|min:30|max:600',
            'maxRow' => 'required|numeric|min:5|max:20'
        ]);

        $hall = Hall::create([
            'title' => $request->title,
            'cinema_id' => $request->cinema,
            'capacity' => $request->capacity,
            'maxRow' => $request->maxRow,
        ]);
        return redirect()->back()->with('success', "سالن با موفقیت ایجاد شد");
    }

    public function Update(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'cinema' => 'required|exists:cinemas,id',
            'capacity' => 'required|numeric|min:30|max:600',
            'maxRow' => 'required|numeric|min:5|max:20'
        ]);

        $hall = Hall::find($request->hall);

        if ($hall){
            $hall->title = $request->title;
            $hall->cinema_id = $request->cinema;
            $hall->capacity = $request->capacity;
            $hall->maxRow = $request->maxRow;

            $hall->save();
            return redirect()->back()->with('success', "سالن با موفقیت ویرایش شد");
        }
        return redirect()->back()->with('error', "سالن یافت نشد");
    }

    public function Delete(Request $request)
    {
        $hall = Hall::find($request->id);
        if ($hall){
            $hall->delete();
            return redirect()->back()->with('success', "سالن با موفقیت حذف شد");
        }
        return redirect()->back()->with('error', "سالن یافت نشد");
    }

    public function getHall(Request $request)
    {
        $request->validate(['cinema' => 'required|exists:cinemas,id']);
        
        return Hall::where('cinema_id', '=', $request->cinema)->get();
    }
}
