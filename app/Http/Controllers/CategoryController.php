<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Show()
    {
        return view('admin.manage_categories', ['categories' => Category::paginate(2)]);
    }

    public function Delete(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
        ]);

        $categoryId = $request->category;

        $category = Category::find($categoryId);

        if ($category) {
            $category->delete();

            return response()->json([
                'message' => 'ژانر با موفقیت پاک شد',
            ]);
        } else {
            return response()->json([
                'message' => 'ژانر یافت نشد',
            ], 404);
        }
    }

    public function Create(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:categories,name'
        ]);

        $category = Category::create(['name' => $request->title]);

        if ($category) {
            return redirect()->back()->with(
                'success' , 'ژانر با موفقیت ایجاد شد',
            );
        } else {
            return response()->json([
                'message' => 'خطا رخ داده است',
            ], 500);
        }
    }
}
