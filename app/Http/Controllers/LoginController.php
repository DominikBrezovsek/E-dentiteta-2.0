<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login.loginForm', [
            'title' => 'Prijava',
            'existingData' => (object) [],
        ]);
    }
    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('user', Auth::user());
            if (Auth::user()->role == 'ADM') {
                return redirect()->route('profile');
            } else if (Auth::user()->role == 'USR') {
                return redirect()->route('profile');
            }
            else if (Auth::user()->role == 'ORG') {
                return redirect()->route('profile');
            }
        }
        else {
            return back()->withErrors([
                'username' => 'Napačno uporabniško ime ali geslo.',
            ])->onlyInput('username');
        }
    }
}