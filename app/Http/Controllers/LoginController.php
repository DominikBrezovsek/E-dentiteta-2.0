<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormValidator;
use App\Models\User;
use Auth;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (isset(session('user')['id'])) {
            switch (session('user')['role']) {
                case('SAD'):
                    return redirect()->route('sad.profile');
                case('OAD'):
                    return redirect()->route('organisation_admin.profile');
                case('PRF'):
                    return redirect()->route('professor.profile');
                case('STU'):
                    return redirect()->route('student.profile');
                case('USR'):
                    return redirect()->route('user.profile');
                case('VEN'):
                    return redirect()->route('vendor.profile');
            }
        }
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
                return redirect()->route('professor.profile');
            } else if (Auth::user()->role == 'VEN') {
                return redirect()->route('vendor.profile');
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


