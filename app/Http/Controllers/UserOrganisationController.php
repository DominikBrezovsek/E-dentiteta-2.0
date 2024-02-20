<?php

namespace App\Http\Controllers;

use App\Models\JoinOrganisationRequest;
use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use App\Models\User;
use App\Notifications\UserRequestedToJoin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        $user = User::whereId($userId)->first();
        if ($user->role == 'USR') {
            JoinOrganisationRequest::create([
                'id_user' => $userId,
                'id_organisation' => $organisationId
            ]);
            $admin = User::whereRole('OAD')->get();
            Notification::send($admin, new UserRequestedToJoin(['uid' => $user->id]));
            return redirect()->route('user.organisations')->with('message', 'Zahteva za pridružitev je bila uspešno ustvarjena');
        }
        return redirect()->route('logout')->withErrors(['username' => 'Neavtorizirano dejanje!']);
    }
}
