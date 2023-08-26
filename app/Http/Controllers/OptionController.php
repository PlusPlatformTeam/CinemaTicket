<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function Show()
    {
        return view('admin.manage_options', ['options' => Option::paginate(2)]);
    }

    public function Create(Request $request)
    {
        $option = Option::create([
            'title' => $request->title,
            'icon' => $request->icon
        ]);

        return redirect()->back()->with('success', "آیکون با موفقیت ایجاد شد");
    } 

    public function Delete(Request $request)
    {
        $option = Option::find($request->id);
        $option->delete();
        return redirect()->back()->with('success', "آیکون با موفقیت حذف شد");
    }
}
