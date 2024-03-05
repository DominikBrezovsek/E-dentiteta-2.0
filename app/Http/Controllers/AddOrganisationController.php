<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Str;
use Mockery\Undefined;
use Illuminate\Pagination\Paginator;

class AddOrganisationController extends Controller
{
    //Add professor
    public function getAddOrganisation(Request $request, Organisation $organisationId){
        return view('systemAdmin.organisation.organisationform',
        ['title' => 'Dodaj organizacijo',
        'existingData' => (object) [],
        'adminInfo' => User::where('role', '=','OAD')->get()]);
    }
    public function postAddOrganisation(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'verified' => ['required', 'in:Y,N'],
            'preverjanje' => ['required', 'in:Y,N'],
            'organisation_admin' => ['required'],
            'description' => ['max:255'],
        ]);

        $organisation = new Organisation([
            'name' => $validatedData['name'],
            'verified' => $validatedData['verified'],
            'checkking_all_cards' => $validatedData['preverjanje'],
            'id_user' => $validatedData['organisation_admin'],
            'description' => $validatedData['description'],
            'id' => Str::uuid(),
        ]);

        $organisation->save();
        return redirect()->route('sad.organisations')->with('message', 'Organizacija ustvarjena!');
    }
    //Edit professor
    public function getOrganisation(Request $request, Organisation $organisationId){
        return view('systemAdmin.organisation.organisationformedit',
        ['title' => 'Dodaj organizacijo',
        'existingData' => $organisationId,
        'adminInfo' => User::where('role', '=','OAD')->get()]);
    }
    public function postOrganisation(Request $request, Organisation $organisationId){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'verified' => ['required', 'in:Y,N'],
            'preverjanje' => ['required', 'in:Y,N'],
            'admin' => ['required'],
            'description' => ['max:255'],
                ]);
        $organisationId->update([
            'name' => $validatedData['name'],
            'verified' => $validatedData['verified'],
            'checkking_all_cards' => $validatedData['preverjanje'],
            'id_user' => $validatedData['admin'],
            'description' => $validatedData['description'],
        ]);
        return redirect()->route('sad.organisations')->with('message', 'Podatki organizacije so bili posodobljeni!');
    }
    //All organisations
    public function getOrganisations(){
        $data = Organisation::paginate(5);
        return view('systemAdmin.organisation.organisations',
        [
            'title' => 'Seznam organizacij',
            'data' => $data,
        ]);
    }
    public function deleteOrganisation(Request $request, Organisation $organisationId){
        $organisationId->delete();
        return redirect()->route('sad.organisations')->with('message', 'Organizacija je bila izbrisana!');
    }
}
