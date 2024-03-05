<?php

namespace App\Http\Controllers;

use App\Models\CardVerification;
use Illuminate\Http\Request;
use App\Models\User;
class QRCodeVerify extends Controller
{
    public function verifyCard(Request $request)
    {
        $cid = $request->input('cid');
        $uid = $request->input('uid');
        $verifyId = $request->input('verifyId');

        // Izvedite poizvedbo
        $exists = CardVerification::where('id_card', $cid)
                           ->where('id_user', $uid)
                           ->where('id_verify', $verifyId)
                           ->exists();
        
        if($exists) {
            // Izvedite poizvedbo
            $data = User::where('id', $uid)->first();
            return response()->json(['data' => $data]);
        }

        // Vrnite odgovor
        return response()->json(['exists' => $exists]);
    }
}
