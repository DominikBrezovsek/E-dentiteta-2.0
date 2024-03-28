<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    function getVendor(){
        $venData = Vendor::whereIdUser(session('user')['id'])->first();
        \Session::put('vid', $venData->id);
        return view('vendor.vendor', [
            'existingData' => $venData
        ]);
    }

    function postVendor(Request $request){
        $venData = Vendor::whereIdUser(session('user')['id'])->first();
        Vendor::whereId(session('vid'))->update([
            'name' => $request->input('name')??$venData->name,
            'adress_line_1' => $request->input('description'),
        ]);
        return redirect()->route('vendor.vendor')->with('message', 'Podatki so bili psoodobljeni!');
    }
}
