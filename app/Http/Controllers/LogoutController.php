<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        Redis::del('user_'.session('user')->id);
        Auth::logout();
        $request->session()->invalidate();

        return redirect()->route('home');
    }
}
