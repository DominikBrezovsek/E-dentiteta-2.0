<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{

    public function generateQRCode()
    {
        return view(
            'user.qrcode.qrcode'

        );
    }

}
