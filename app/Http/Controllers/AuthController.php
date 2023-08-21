<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin(){
        return view('content.login');
    }

    public function checkLogin(Request $request)
    {
        $credentails = $request->validate([
            'email' => ['required', 'Email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentails)) {
            $request->session()->regenerate();
            return redirect()->intended('/content');
        }
        return back()->withErrors([
            'email' => 'Creadentials do not match our records',
        ]);
    }

    public function logout(){
        Auth::logout();
        return view('content.login');
    }

}
