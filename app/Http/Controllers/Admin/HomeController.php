<?php

namespace App\Http\Controllers\Admin;

use App\Client;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Reply;
use App\Story;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $stories = Story::with('section', 'client')->latest()->get();
        return view('backend.home')->with(['stories'=>$stories]);
    }

    public function active($id){
        $story = Story::find($id);
        $story->status = 0;

        $story->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Successfully Active.'
        ]);
    }

    public function block($id){
        $story = Story::find($id);
        $story->status = 1;

        $story->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Successfully Blocked.'
        ]);
    }

    public function unlisted($id){
        $story = Story::find($id);
        $story->status = 2;

        $story->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Successfully Unlisted.'
        ]);
    }

    public function users(){
        $users = Client::latest()->get();
        return view('backend.users')->with(['users'=>$users]);
    }


    public function clientActive($id){
        $client = Client::find($id);
        $client->status = 1;

        $client->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Successfully Active.'
        ]);
    }

    public function clientBlock($id){
        $client = Client::find($id);
        $client->status = 2;

        $client->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Successfully Blocked.'
        ]);
    }

    public function clientSearch(Request $request){
        if($search = $request->search){
            $users = Client::orWhere('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('gender', 'LIKE', "%$search%")->get();
        }
        return view('backend.users')->with(['users'=>$users]);
    }

    public function storyDetails($id)
    {
        $story = Story::with('comments')->where('id', $id)->first();
        return view('backend.story_details')->with(['story'=>$story]);
    }

    public function deleteComment($id){
        $reply = Reply::where('comment_id', $id)->exists();

        if($reply) {
            Reply::where([
                'comment_id' => $id
            ])->delete();

            Comment::where([
                'id' => $id
            ])->delete();

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Successfully deleted.'
            ]);
        }

        Comment::where([
            'id' => $id
        ])->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully deleted.'
        ]);
    }

    public function deleteReply($id){
        Reply::where([
            'id' => $id
        ])->delete();


        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Successfully deleted.'
        ]);
    }
}
