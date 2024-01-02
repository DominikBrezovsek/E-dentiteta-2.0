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
            'existingData' => User::where('id', session('user')->id)->first(),
        ]);
    }
    public function postProfileAdmin(Request $request){
        $request->validate([
            'name' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
        ]);
        User::where('id', session('user')->id)->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        return redirect()->route('admin.profile')->with('message', 'Profil je bil posodobljen!');
    }
    public function getProfileUser()
    {
        return view('user.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')->id)->first(),
        ]);
    }
    public function getProfileOrganisation()
    {
        return view('organisation.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')->id)->first(),
        ]);
    }
}
