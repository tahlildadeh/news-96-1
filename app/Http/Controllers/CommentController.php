<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\Http\Requests;

class CommentController extends Controller
{
    public function create(Request $request, $id)
    {
        $this->validate($request, [
            'message' => 'required|min:5',
        ]);

        $currentComment = Comment::find($id);

        if(!$currentComment){
            session()->flash('error_message', "comment {$id} does not exists");
            return back()->withInput();
        }


        $comment = $currentComment->submitComment($request->message, \Auth::user());

        if(!$comment) {
            session()->flash('error_message', 'Your comment could not be saved');
            return back()->withInput();
        }

        session()->flash('success_message', 'Your comment added');
        return back();
    }
}
