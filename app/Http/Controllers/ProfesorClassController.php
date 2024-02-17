<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorClassController extends Controller
{
    public function getClass(Request $request){
        return view('professor.class.class');
    }
}
