<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class ProfileController extends Controller
{
    public function getProfileAdmin()
    {
        $this->redisSetProfile(session('user')->id);
        return view('admin.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')->id)->first(),
        ]);
    }

    public function redisSetProfile($userId){
        $cachedUser = Redis::get('user_'.$userId);
        if (!isset($cachedUser)) {
            $user = User::select(['name', 'surname', 'username', 'email', 'emso', 'created_at'])->whereId($userId)->first();
            Redis::set('user_' . $userId, $user, "EX", 15*60 );
        } else {
            Redis::del('user_'.$userId);
            $user = User::select(['name', 'surname', 'username', 'email', 'emso', 'created_at'])->whereId($userId)->first();
            Redis::set('user_' . $userId, $user,"EX", 15*60 );

        }
    }
    public function redisGetProfile()
    {
        $userId = session('user')->id;
        return Redis::get('user_'.$userId);
    }
    public function postProfileAdmin(ProfileValidator $request){
        $request->validated();
        User::where('id', session('user')->id)->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        $this->redisSetProfile(session('user')->id);
        return redirect()->route('admin.profile')->with('message', 'Profil je bil posodobljen!');
    }
    //TODO: CHANGE THIIS
    public function postProfileOrganisation(ProfileValidator $request){
        $request->validated();
        User::where('id', session('user')->id)->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        $this->redisSetProfile(session('user')->id);
        return redirect()->route('organisation.profile')->with('message', 'Profil je bil posodobljen!');
    }
        //TODO: CHANGE THIIS
        public function postProfileUser(ProfileValidator $request){
            $request->validated();
            User::where('id', session('user')->id)->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
            ]);
            $this->redisSetProfile(session('user')->id);
            return redirect()->route('user.profile')->with('message', 'Profil je bil posodobljen!');
        }
    public function getProfileUser()
    {
        $this->redisSetProfile(session('user')->id);
        return view('user.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')->id)->first(),
                //(Redis::get('user_'.session('user')->id))
                //
        ]);
    }
    public function getProfileOrganisation()
    {
        $this->redisSetProfile(session('user')->id);
        return view('organisation.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')->id)->first(),
        ]);
    }
}
