<?php

namespace App\Http\Controllers;

use App\Models\CardVerification;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classes;

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
        if ($exists) {
            // Izvedite poizvedbo
            $data = User::where('id', $uid)->first();
            return response()->json(['data' => $data]);
        }

        // Vrnite odgovor
        return response()->json(['exists' => $exists]);
    }
    public function verifyCardOAD(Request $request)
    {
        $cid = $request->input('cid');
        $uid = $request->input('uid');
        $verifyId = $request->input('verifyId');

        // Izvedite poizvedbo
        $exists = CardVerification::where('id_card', $cid)
            ->where('id_user', $uid)
            ->where('id_verify', $verifyId)
            ->exists();
        if ($exists) {
            if (Students::where('id', $uid)->exists()) {
                $data = User::where('id', $uid)->first();

                return response()->json(['data' => $data]);
            } else {
                return response()->json(['error' => 'Not a student']);
            }
        }

        // Vrnite odgovor
        return response()->json(['exists' => $exists]);
    }
    public function verifyCardPRF(Request $request)
    {
        $cid = $request->input('cid');
        $uid = $request->input('uid');
        $verifyId = $request->input('verifyId');

        // Izvedite poizvedbo
        $exists = CardVerification::where('id_card', $cid)
            ->where('id_user', $uid)
            ->where('id_verify', $verifyId)
            ->exists();

        $id_user = session('user')['id'];
        if ($exists) {
            if (Students::where('id', $uid)->where('id_class', Classes::where("id_teacher", $id_user) )->exists()) {
                $data = User::where('id', $uid)->first();

                return response()->json(['data' => $data]);
            } else {
                return response()->json(['error' => 'Not a student']);
            }
        }

        // Vrnite odgovor
        return response()->json(['exists' => $exists]);
    }
}
