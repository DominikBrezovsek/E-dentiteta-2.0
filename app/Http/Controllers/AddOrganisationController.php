<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Support\Str;
use Mockery\Undefined;

class AddOrganisationController extends Controller
{
    //Add organisation
    public function getAddOrganisation(Request $request, Organisation $organisationId){
        return view('admin.organisation.organisationform',
        ['title' => 'Dodaj organizacijo',
        'existingData' => (object) [],
        'adminInfo' => User::where('role', 'ADM')->get()]);
    }
    public function postAddOrganisation(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'verified' => ['required', 'in:Y,N'],
            'preverjanje' => ['required', 'in:Y,N'],
            'admin' => ['required'],
            'description' => ['max:255'],
        ]);

        $organisation = new Organisation([
            'name' => $validatedData['name'],
            'verified' => $validatedData['verified'],
            'checkking_all_cards' => $validatedData['preverjanje'],
            'id_user' => $validatedData['admin'],
            'description' => $validatedData['description'],
            'id' => Str::uuid(),
        ]);

        $organisation->save();
        return redirect()->route('admin.organisations')->with('message', 'Organizacija ustvarjena!');
    }
    //Edit organisation
    public function getOrganisation(Request $request, Organisation $organisationId){
        return view('admin.organisation.organisationformedit',
        ['title' => 'Dodaj organizacijo',
        'existingData' => $organisationId,
        'adminInfo' => User::where('role', 'ADM')->get()]);
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
        return redirect()->route('admin.organisations')->with('message', 'Podatki organizacije so bili posodobljeni!');
    }
    //All organisations
    public function getOrganisations(){
        return view('admin.organisation.organisations',
        ['title' => 'Seznam organitacij',
        'data' => Organisation::join('users', 'organisations.id_user', '=', 'users.id')->select('organisations.name AS name', 'verified', 'checkking_all_cards', 'username', 'organisations.id AS id_organisation')->get()]);
    }
    public function deleteOrganisation(Request $request, Organisation $organisationId){
        $organisationId->delete();
        return redirect()->route('admin.organisations')->with('message', 'Organizacija je bila izbrisana!');
    }
}
