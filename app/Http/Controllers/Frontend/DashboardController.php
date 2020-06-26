<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $stories = Story::where('client_id', Auth::guard('client')->user()->id)->latest()->get();
        return view('frontend.my_timeline')->with([
            'stories' => $stories
        ]);;
    }
}
