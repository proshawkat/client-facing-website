<?php

namespace App\Http\Controllers\Frontend;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id){
        $request->validate([
            'comment'         => 'required',
        ]);

        $comment = new Comment();

        $comment->client_id = Auth::guard('client')->user()->id;
        $comment->story_id = $id;
        $comment->comment = $request->comment;

        $comment->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Comment has been successfully added.'
        ]);
    }

    public function replyStore(Request $request, $id){
        $request->validate([
            'reply'         => 'required',
        ]);

        $reply = new Reply();

        $reply->client_id = Auth::guard('client')->user()->id;
        $reply->comment_id = $id;
        $reply->reply = $request->reply;

        $reply->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Reply has been successfully added.'
        ]);
    }
}
