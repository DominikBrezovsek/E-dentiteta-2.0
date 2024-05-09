<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeaherApiController extends Controller
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

        $userStatus = User::authenticate($username, $password, 'PRF');

        if (isset($userStatus->id)) {
            Session::put('userId', $userStatus->id);
            Session::put('role', $userStatus->role);
            return response(json_encode([
                'status' => 'success',
                'message' => 'Login success.',
                'userId' => $userStatus->id
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
}
