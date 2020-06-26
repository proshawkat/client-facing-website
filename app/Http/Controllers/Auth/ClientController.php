<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }

    protected function create(Request $request)
    {
        $client = new Client();

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|confirmed'
        ]);

        $requestAll = $request->all();
        $requestAll['date_of_birth']        = Carbon::parse($request->date_of_birth);
        $requestAll['status']               = 1;
        $requestAll['password']             = Hash::make($request->password);

//        dd($request->has('avatar'));
        if ($request->has('avatar')) {
            $image      = $request->file('avatar');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/client', $fileName);
            $requestAll['avatar']                       = $fileName;
        }

        $client->fill($requestAll)->save();

        if(!empty($client)){
            return redirect()->back()->with([
                'status'    => 'success',
                'message'      => 'Successfully Register'
            ]);
        }
    }

    public function login(Request $request){

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->get('remember'))) {
            return redirect()->intended('/');
        }
        $errors = new MessageBag(['password' => ['Authentication invalid.']]);
        return Redirect::back()->withErrors($errors)->withInput($request->only('email','remember'));;
    }
}
