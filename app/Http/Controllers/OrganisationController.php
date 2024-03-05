<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
    function getOrganisation(){
        $oid = OrganisationAdmin::whereIdUser(session('user')['id'])->first()->id_organisation;
        $orgData = Organisation::whereId($oid)->first();
        \Session::put('oid', $orgData->id);
        return view('organisation_admin.organisation.organisation', [
            'existingData' => $orgData
        ]);
    }

    function postOrganisation(Request $request){
        $oldLogo = Organisation::whereId(session('oid'))->first();
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if ($oldLogo->logo != 'default.png') {
                Storage::disk('public')->delete('images/'.$oldLogo->logo);
            }
            $logoName = time().'.'.$request->logo->extension();
            $request->logo->storeAs('images', $logoName, 'public');
        } else {
            if ($oldLogo->logo != 'default.png') {
                Storage::disk('public')->delete('images/'.$oldLogo->logo);
            }
        }
        Organisation::whereId(session('oid'))->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'logo' => $request->input('logoName') ?? $logoName ?? 'default.png',
        ]);
        return redirect()->route('organisation_admin.organisation')->with('message', 'Organizacija je bila posodobljena!');
    }
}
