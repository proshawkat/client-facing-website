<?php

namespace App\Http\Controllers\Auth;

use App\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:client')->except('logout');
    }

    protected function create(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        return Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'status' => 1,
            'avatar' => 'a.jpg',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->intended('/');
    }

    public function login(Request $request){

        $this->validate($request, [
            'email'   => 'required|email|exists:clients,status,1',
            'password' => 'required'
        ]);


        if (Auth::guard('client')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
//            dd($request->all());

            return redirect()->intended('/');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
}
