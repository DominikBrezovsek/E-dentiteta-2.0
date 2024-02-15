<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormValidator;
use Auth;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('login.loginForm', [
            'title' => 'Prijava',
            'existingData' => (object)[],
        ]);
    }

    public function postLogin(LoginFormValidator $request): RedirectResponse
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->put('user', Auth::user());
            if (Auth::user()->role == 'SAD') {
                return redirect()->route('sad.profile');
            } else if (Auth::user()->role == 'USR') {
                return redirect()->route('user.profile');
            } else if (Auth::user()->role == 'STU') {
                return redirect()->route('student.profile');
            } else if (Auth::user()->role == 'OAD') {
                return redirect()->route('organisation_admin.profile');
            } else if (Auth::user()->role == 'PRF') {
                return redirect()->route('student.profile');
            } else if (Auth::user()->role == 'VEN') {
                return redirect()->route('vendor.profile.profile');
            }
        } else {
            return back()->withErrors([
                'username' => 'Napačno uporabniško ime ali geslo.',
            ])->onlyInput('username');
        }
        return back()->withErrors([
            'username' => 'Napačno uporabniško ime ali geslo.',
        ])->onlyInput('username');
    }
}
