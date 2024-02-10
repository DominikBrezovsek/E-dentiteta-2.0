<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CronController extends Controller
{
    public function runCron(Request $request){
        DB::table('card_verifications')->where('expires', '<', time())->delete();
        DB::table('password_resets')->where('expires', '<', time())->delete();
    }
}
