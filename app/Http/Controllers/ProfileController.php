<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileValidator;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class ProfileController extends Controller
{
    public function getProfileAdmin()
    {
        $this->redisSetProfile(session('user')['id'], 'OAD');
        return view('organisation_admin.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')['id'])->first(),
        ]);
    }

    public function redisSetProfile($userId, $type){
        $cachedUser = Redis::get('user_'.$userId);
        if (!isset($cachedUser)) {
            switch ($type) {
                case ('OAD'):
                    $user = User::select(['name', 'surname', 'username', 'email', 'emso', 'id_organisation'])
                        ->join('organisation_admins AS OA', 'OA.id_user', '=', 'users.id')
                        ->whereId($userId)->first();
                    $showCardRequests = Card::whereIdOrganisation($user->id_organisation)->where('auto_join', '=', 'N')->exists();
                    Redis::set('cardRequests_'.$user->id_organisation, $showCardRequests, "EX", 15*60);
                    break;
                case ('PRF'):
                    $user = User::select(['name', 'surname', 'username', 'email', 'emso', 'id_organisation'])
                        ->join('teachers', 'teachers.id_user', '=', 'users.id')
                        ->where('users.id', $userId)->first();
                    $showCardRequests = Card::whereIdOrganisation($user->id_organisation)->where('auto_join', '=', 'N')->exists();
                    Redis::set('cardRequests_'.$user->id_organisation, $showCardRequests, "EX", 15*60);
                    break;
                default:
                    $user = User::select(['name', 'surname', 'username', 'email', 'emso'])->whereId($userId)->first();
            }
            Redis::set('user_' . $userId, $user, "EX", 15*60 );
        }
    }
    public function redisGetProfile()
    {
        $userId = session('user')['id'];
        return Redis::get('user_'.$userId);
    }
    public function postProfileAdmin(ProfileValidator $request){
        $request->validated();
        User::where('id', session('user')['id'])->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        $this->redisSetProfile(session('user')['id'], 'OAD');
        return redirect()->route('organisation_admin.profile')->with('message', 'Profil je bil posodobljen!');
    }
    //TODO: CHANGE THIIS
    public function postProfileProfessor(ProfileValidator $request){
        $request->validated();
        User::where('id', session('user')['id'])->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        $this->redisSetProfile(session('user')['id'], 'PRF');
        return redirect()->route('professor.profile')->with('message', 'Profil je bil posodobljen!');
    }
        //TODO: CHANGE THIIS
        public function postProfileStudent(ProfileValidator $request){
            $request->validated();
            User::where('id', session('user')['id'])->update([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
            ]);
            $this->redisSetProfile(session('user')['id'], 'STU');
            return redirect()->route('student.profile')->with('message', 'Profil je bil posodobljen!');
        }
    public function getProfileUser()
    {
        $this->redisSetProfile(session('user')['id'], 'USR');
        return view('student.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')['id'])->first(),
                //(Redis::get('user_'.session('student')->id))
                //
        ]);
    }
    public function getProfileProfessor()
    {
        $this->redisSetProfile(session('user')['id'], 'PRF');
        return view('professor.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')['id'])->first(),
        ]);
    }

    public function getProfileSystemAdmin()
    {
        $this->redisSetProfile(session('user')['id'], 'SAD');
        return view('systemAdmin.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')['id'])->first(),
        ]);
    }
    public function postProfileSystemAdmin(ProfileValidator $request){
        $request->validated();
        User::where('id', session('user')['id'])->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        $this->redisSetProfile(session('user')['id'], 'SAD');
        return redirect()->route('sad.profile')->with('message', 'Profil je bil posodobljen!');
    }

    public function getProfileVendor()
    {
        $this->redisSetProfile(session('user')['id'], 'VEN');
        return view('vendors.profile.profileForm', [
            'title' => 'Profil',
            'existingData' => User::where('id', session('user')['id'])->first(),
        ]);
    }
    public function postProfileVendor(ProfileValidator $request){
        $request->validated();
        User::where('id', session('user')['id'])->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
        ]);
        $this->redisSetProfile(session('user')['id'], 'VEN');
        return redirect()->route('vendor.profile')->with('message', 'Profil je bil posodobljen!');
    }


}

