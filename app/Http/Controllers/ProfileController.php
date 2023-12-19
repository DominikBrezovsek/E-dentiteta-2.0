<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function getProfileAdmin()
    {
        return view('admin.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id_user', session('user')->id_user)->first(),
        ]);
    }
    public function getProfileUser()
    {
        return view('user.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id_user', session('user')->id_user)->first(),
        ]);
    }
    public function getProfileOrganisation()
    {
        return view('organisation.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id_user', session('user')->id_user)->first(),
        ]);
    }
}
