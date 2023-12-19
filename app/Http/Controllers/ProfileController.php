<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function getProfile()
    {
        return view('profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id_user', session('user')->id_user)->first(),
        ]);
    }
}
