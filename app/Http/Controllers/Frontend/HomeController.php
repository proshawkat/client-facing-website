<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Share;
use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $stories = Story::where('status', 0)->latest()->get();
        return view('frontend.home')->with(['stories'=>$stories]);
    }

    public function sectionWiseStory($id){
        $stories = Story::where('section_id', $id)->latest()->get();
        return view('frontend.home')->with(['stories'=>$stories]);
    }

    public function share($id){
        $share = new Share();

        $share->client_id = Auth::guard('client')->user()->id;
        $share->story_id = $id;
        $share->save();

        return redirect()->back()->with([
            'status'    => 'success',
            'message'      => 'Shared successfully.'
        ]);
    }

    public function search(Request $request){
        if($search = $request->search){
            $stories = Story::with('tags')
                ->orWhereHas('tags' , function($query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->orWhereHas('section' , function($query) use ($search) {
                    $query->where('title', 'LIKE', "%$search%");
                })
                ->orWhere('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")->get();
        }else{
            $stories = Story::latest()->get();
        }
        return view('frontend.home')->with(['stories'=>$stories]);
    }
}
