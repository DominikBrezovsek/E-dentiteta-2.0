<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Mockery\Undefined;
use Illuminate\Pagination\Paginator;
use App\Models\Vendor;

class AddVendorController extends Controller
{
    public function getAddVendor(Request $request, Vendor $vendorId){
        return view('systemAdmin.vendor.vendorform',
        ['title' => 'Dodaj partnerja',
        'existingData' => (object) [],
        'adminInfo' => User::where('role', '=','USR')->whereNotIn('id', Vendor::all('id_user'))->get()]);
    }
    public function postAddVendor(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'address_line_1' => ['required', 'max:255'],
            'address_line_2' => ['required', 'integer'],
            'postal_code' => ['required', 'integer'],
            'city' => ['required', 'max:255'],
            'country' => ['required', 'max:255'],
            'admin' => ['required'],
        ]);

        $organisation = new Vendor([
            'name' => $validatedData['name'],
            'address_line_1' => $validatedData['address_line_1'],
            'address_line_2' => $validatedData['address_line_2'],
            'postal_code' => $validatedData['postal_code'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'id_user' => $validatedData['admin'],
            'verified_by' => session('user')['id'],
            'id' => Str::uuid(),
        ]);
        User::whereId($validatedData['admin'])->update([
            'role' => 'VEN',
        ]);


        $organisation->save();
        return redirect()->route('sad.vendors')->with('message', 'Partner je bil ustvarjen!');
    }

    public function getVendor(Request $request, Vendor $vendorId){
        return view('systemAdmin.vendor.vendorformedit',
        ['title' => 'Dodaj partnerja',
        'existingData' => $vendorId,
        'adminInfo' => User::where('role', '=','VEN')->whereNotIn('id', Vendor::where("id_user", "!=", $vendorId->id_user)->get("id_user"))->get()]);
    }
    public function postVendor(Request $request, Vendor $vendorId){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'address_line_1' => ['required', 'max:255'],
            'address_line_2' => ['required', 'integer'],
            'postal_code' => ['required', 'integer'],
            'city' => ['required', 'max:255'],
            'country' => ['required', 'max:255'],
            'admin' => ['required'],
                ]);
        $vendorId->update([
            'name' => $validatedData['name'],
            'address_line_1' => $validatedData['address_line_1'],
            'address_line_2' => $validatedData['address_line_2'],
            'postal_code' => $validatedData['postal_code'],
            'city' => $validatedData['city'],
            'country' => $validatedData['country'],
            'id_user' => $validatedData['admin'],
        ]);
        User::whereId($vendorId->id_user)->update([
            'role' => 'VEN',
        ]);
        return redirect()->route('sad.vendors')->with('message', 'Podatki partnerja so bili uspešno posodobljeni!');
    }

    public function getVendors(){
        $data = Vendor::paginate(5);
        return view('systemAdmin.vendor.vendors',
        [
            'title' => 'Seznam partnerjev',
            'data' => $data,
        ]);
    }
    public function deleteVendor(Request $request, Vendor $vendorId){
        $vendorId->delete();
        return redirect()->route('sad.vendors')->with('message', 'Pertner je bil izbrisan!');
    }
}
