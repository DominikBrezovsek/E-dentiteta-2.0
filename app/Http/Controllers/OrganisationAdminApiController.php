<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class OrganisationAdminApiController extends Controller
{
    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        if ($username == null || $password == null) {
            return response()->json([
                'status' => 'error',
                'message' => 'missing data'
            ]);
        }

        $userStatus = User::authenticate($username, $password, 'OAD');

        if (isset($userStatus->id)) {
            Session::put('userId', $userStatus->id);
            Session::put('role', $userStatus->role);
            Redis::set('user_'.$userStatus->id, $userStatus);
            return response(json_encode([
                'status' => 'success',
                'message' => 'Login success.',
            ]), 200);
        } else {
            return response(json_encode([
                'status' => 'failed',
                'message' => 'Login failed.',
            ]), 200);
        }
    }

    public function logout() {
        Session::flush();
        return response(json_encode([
            'status' => 'success',
            'message' => 'Logout success.',
        ]));
    }

    public function getUser(){
        if (Session::has('userId')){
            $user  = Redis::get('user_'.Session::get('userId'));
            $userDecoded = json_decode($user, true);
            return response(json_encode([
                'status' => 'success',
                'data' => $userDecoded,
            ]));
        }
        return response(json_encode([
            'status' => 'failed',
            'message' => 'Uporabnik ne obstaja!',

        ]));
    }
}
