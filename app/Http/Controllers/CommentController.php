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
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function Accept(Request $request)
    {
        $comment = Comment::find($request->id);

        if ($comment){
            $comment->state = Comment::ACCEPT;
            $comment->save();
            return redirect()->back()->with('success', 'کامنت تایید شد.');
        }
        return redirect()->back()->with('error', 'کامنت پیدا نشد.');

    }

    public function Reject(Request $request)
    {
        $comment = Comment::find($request->id);

        if ($comment){
            $comment->state = Comment::REJECT;
            $comment->save();
            return redirect()->back()->with('success', 'کامنت رد شد.');
        }
        return redirect()->back()->with('error', 'کامنت پیدا نشد.');

    }

}
