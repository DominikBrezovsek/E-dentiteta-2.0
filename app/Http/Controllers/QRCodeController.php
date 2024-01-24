<?php

namespace App\Http\Controllers;

use App\Models\CardVerification;
use App\Models\UserCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class QRCodeController extends Controller
{
    public string $cardName;
    public function generateQRCode()
    {
        $payload = $this->createCode();
        return view(
            'user.qrcode.qrcode',
            [
                'payload' => $payload,
                'cardName' => $this->cardName
            ]
        );
    }

    public function createCode(): string
    {
        $url = parse_url(URL::full(), PHP_URL_PATH);
        $cardId = explode('/', $url)[4];
        $cardData = UserCard::where('id_card', '=', $cardId)->where('id_user', '=', session('user')['id'])->join('cards', 'id_card', '=', 'cards.id')->first();
        $this->cardName = $cardData->name;
        try {
            CardVerification::whereIdUser($cardData->id_user)->whereIdCard($cardData->id_card)->delete();
            $chkSeq = uuid_create();
            DB::table('card_verifications')->insert([
                'id_verify' => uuid_create(),
                'id_user' => $cardData->id_user,
                'id_card' => $cardData->id_card,
                'check_seq' => $chkSeq,
                'expires' => time() + 2*60
            ]);
            return 'uid=' . $cardData->id_user . '?' . 'cid=' . $cardData->id_card . '?' . 'chk=' . $chkSeq;
        } catch (\Exception $e) {
            return $e;
        }
    }

}
