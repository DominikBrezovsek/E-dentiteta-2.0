<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeScanner extends Controller
{
    public function getScanner()
    {
        return view('cardScanner.cardScanner');
    }
}
