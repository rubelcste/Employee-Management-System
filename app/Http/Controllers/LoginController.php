<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   public function indexAdmin(){
        return view('auth.index');
    }
    public function AdminAuthenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|min:6',
            'password' => 'required|min:7',
        ]);

        //try to login the user
        if (Auth::guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))) {
            // Authentication passed...
            return redirect()->route('admin.dashboard');
        }else{
            // Authentication failed...
            //redirect the user with the old input
            return redirect('/admin')->withInput()->with('info','Invalid Credentials!');
        }
    }
    public function indexUser(){
        return view('auth.user_index');
    }
    public function UserAuthenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|min:6',
            'password' => 'required|min:7',
        ]);

        //try to login the user
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))) {
            // Authentication passed...
            return redirect()->route('user.dashboard');
        }else{
            // Authentication failed...
            //redirect the user with the old input
            return redirect('/user')->withInput()->with('info','Invalid Credentials!');
        }
    }

}
