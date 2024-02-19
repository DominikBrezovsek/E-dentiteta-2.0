<?php

namespace App\Http\Controllers;

use App\Models\JoinOrganisationRequest;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Http\Request;

class UserOrganisationController extends Controller
{
    public function getOrganisations()
    {
        return view('user.joinOrganisation.organisations', [
            'organisations' => Organisation::paginate(5)
        ]);
    }

    public function postJoinOrganisation(Request $request, $organisationId)
    {
        $userId = session('user')['id'] != null ? session('user')['id'] : redirect()->back()->withErrors(['name' => 'Nepričakovana napaka.']);
        if (User::whereId($userId)->first()->role == 'USR') {
            JoinOrganisationRequest::create([
                'id_user' => $userId,
                'id_organisation' => $organisationId
            ]);
            return redirect()->route('user.organisations')->with('message', 'Zahteva za pridružitev je bila uspešno ustvarjena');
        }
        return redirect()->route('logout')->withErrors(['username' => 'Neavtorizirano dejanje!']);
    }
}
