<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use function MongoDB\BSON\toJSON;

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
            \session('userId', $userStatus->id);
            Redis::set('user_'.$userStatus->id, $userStatus);
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

    public function logout(Request $request) {
        Session::flush();
        Redis::del('userId_'.$request->userId);
        return response(json_encode([
            'status' => 'success',
            'message' => 'Logout success.',
        ]));
    }

    public function getUser(Request $request){
        if ($request->userId != null){
            $user  = Redis::get('user_'.$request->userId);
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

    public function getCards(Request $request){
        if ($request->userId != null){
            $user  = Redis::get('user_'.$request->userId);
            $userDecoded = json_decode($user, true);
            $organisationAdmin = OrganisationAdmin::findUserById($userDecoded["id"]);
            if ($organisationAdmin != null){
                Redis::set('OAD_'.$userDecoded["id"], $organisationAdmin);
            }
            $cards  = Card::getAllCards($organisationAdmin->id_organisation);
            if ($cards != null){
                return response($cards->toJson(), 200);
            }
            return response(json_encode([
                'status' => 'failed',
                'message' => 'Uporabnik ne obstaja!',
            ]));
        }
    }

    public function createCard(Request $request){
        if ($request->userId != null){
            $user  = Redis::get('OAD_'.$request->userId);
            $userDecoded = json_decode($user, true);
            if ($userDecoded != null){
                $cards = Card::createCard(request()->all(), $userDecoded["id_organisation"]);
                if ($cards != null){
                    return response($cards->toJson(), 200);
                }
                return response(json_encode([
                    'status' => 'failed',
                ]));
            }
            return response(json_encode([
                'status' => $user,
            ]));
        }
        return response(json_encode([
            'status' => 'failed',
        ]));
    }
}
