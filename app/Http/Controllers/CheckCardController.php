<?php

namespace App\Http\Controllers;

use App\Models\CardVerification;
use App\Models\User;
use App\Models\UserCard;
use Auth;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CheckCardController extends Controller
{
    public function verifyCard(Request $request){
        return view(
            'cardVerification.cardVerification',
            [
                'slug' => $this->checkValidity($request)
            ]
        );
    }

    private function checkValidity(Request $request){
        $verificationId = $request->input('verifyId');
        $userId = $request->input('uid');
        $cardId = $request->input('cid');
        if ($verificationId != null && $userId != null && $cardId != null){
            if(CardVerification::whereIdVerify($verificationId)->count('*') > 0){
                if (Auth::user() && Auth::user()->role == 'OAD' || Auth::user() && Auth::user()->role == 'SAD' || Auth::user() && Auth::user()->role == 'PRF')  {
                    $data = UserCard::select(['users.*', 'cards.name AS cardName'])->whereIdUser($userId)->join('users', 'users.id', '=', 'user_cards.id_user')->join('cards', 'cards.id', '=', 'user_cards.id_card')->first();
                    $userData = [
                        'ime' => $data->name,
                        'priimek' => $data->surname,
                        'card' => $data->cardName,
                        'message' => 'Kartica je veljavna'
                    ];
                    return $userData;
                }
                return "Verifikacijska koda je veljavna";
            }
            else {
                return "Verifikacijska koda ni veljavna!";
            }
        }
        else {
            return "Nevejaven URL naslov!";
        }
    }
}
