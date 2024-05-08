<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\Students;
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
        Redis::del('user_'.$request->userId);
        Redis::del('OAD_'.$request->userId);
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

    public function updateCard(Request $request){
        if ($request->cardId != null){
            Card::updateById($request->all());
        } else {
            return response(json_encode([
                'status' => 'failed',
            ]));
        }
    }

    public function deleteCard(Request $request){
        if ($request->cardId != null){
            Card::deleteById($request->cardId);
        } else {
            return response(json_encode([
                'status' => 'failed',
            ]));
        }
    }


    public function getStudents(Request $request){
        if ($request->userId != null){
            $user  = Redis::get('OAD_'.$request->userId);
            $userDecoded = json_decode($user, true);
            if ($userDecoded != null){
                $students = Students::getAllStudents($userDecoded["id_organisation"]);
                if ($students != null){
                    return response($students->toJson(), 200);
                } else {
                    return response(json_encode([
                        'status' => 'failed',
                    ]));
                }

            } else {
                return response(json_encode([
                    'status' => 'failed',
                ]));
            }
        } else {
            return response(json_encode([
                'status' => 'missing data',
            ]));
        }
    }

    public function updateStudent(Request $request){
        if ($request->userId != null){
            $user  = Redis::get('OAD_'.$request->userId);
            $userDecoded = json_decode($user, true);
            if ($userDecoded != null){
                Students::updateByEmso($userDecoded["id_organisation"], request()->all());
                return response(json_encode([
                    'status' => 'success',
                    'message' => 'Update success.'
                ]));
            } else {
                return response(json_encode([
                    'status' => 'failed',
                ]));
            }
        }
    }

    public function deleteStudent(Request $request){
        if ($request->emso != null){
                Students::deleteByEmso($request->emso);
            } else {
            return response(json_encode([
                'status' => 'failed',
            ]));
        }
    }
}
