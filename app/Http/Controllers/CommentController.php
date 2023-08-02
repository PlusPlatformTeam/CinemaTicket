<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    public function addComment(Request $request)
    {

        $message = $request->input('message');

        $comment = Comment::create([
            'body' => $message,
            'user_id' => Auth::user()->id,
            'movie_id' => $request->input("movie_id")?$request->input("movie_id"):null,
            'cinema_id' => $request->input("cinema_id")?$request->input("cinema_id"):null,

        ]);
    
        // Do something with the new comment, such as redirecting to a page or returning a response
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

}
