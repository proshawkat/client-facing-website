<?php

namespace App\Http\Controllers\Frontend;

use App\Client;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index(){
        return view('frontend.settings');
    }

    public function update(Request $request){

        $client = Client::find(Auth::guard('client')->user()->id);
        $request->validate([
            'name'                => 'required',
            'email'                 => 'required',
            'phone'                  => 'required',
            'date_of_birth'             => 'required',
            'gender'                    => 'required',
        ]);

        $requestAll = $request->all();
        $requestAll['date_of_birth'] = Carbon::parse($request->date_of_birth);

        if ($request->has('avatar')) {
            unlink(storage_path('app/public/client/' . $client->avatar));
            $image      = $request->file('avatar');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/client', $fileName);
            $requestAll['avatar']                       = $fileName;
        }
        $client->fill($requestAll)->save();

        if(!empty($client)){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Your profile has been successfully updated'
            ]);
        }
    }
}
