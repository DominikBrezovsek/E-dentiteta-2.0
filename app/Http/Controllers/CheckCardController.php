<?php

namespace App\Http\Controllers;

use App\Models\CardVerification;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CheckCardController extends Controller
{
    public string $verificationId;
    public function verifyCard(Request $request){
        return view(
            'cardVerification.cardVerification',
            [
                'slug' => $this->checkValidity($request)
            ]
        );
    }

    private function checkValidity(Request $request){
        $this->verificationId = $request->input('verifyId');
        $userId = $request->input('uid');
        $cardId = $request->input('cid');

        if ($this->verificationId != null && $userId != null && $cardId != null){
            if(CardVerification::whereIdVerify($this->verificationId)->count('*') > 0){
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
