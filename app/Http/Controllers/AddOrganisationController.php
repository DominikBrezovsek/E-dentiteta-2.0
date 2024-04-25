<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\OrganisationAdmin;
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
        'adminInfo' => User::all()->where('role', '!=','OAD')->where('role', '!=','SAD')]);
    }
    public function postAddOrganisation(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'verified' => ['required', 'in:Y,N'],
            'admin' => ['required'],
            'description' => ['max:255'],
        ]);

        $organisation = new Organisation([
            'name' => $validatedData['name'],
            'verified' => $validatedData['verified'],
            'description' => $validatedData['description'],
            'id' => Str::uuid(),
        ]);
        $organisation->save();
        $oid = Organisation::where('name', $validatedData['name'])->first()->id;
        OrganisationAdmin::create([
            'id_admin' => Str::uuid(),
            'id_organisation' => $oid,
            'id_user' => $validatedData['admin']
        ]);
        User::where('id', $validatedData['admin'])->update(['role' => 'OAD']);

        return redirect()->route('sad.organisations')->with('message', 'Organizacija ustvarjena!');
    }
    //Edit professor
    public function getOrganisation(Request $request, Organisation $organisationId){
        return view('systemAdmin.organisation.organisationformedit',
        ['title' => 'Dodaj organizacijo',
        'existingData' => $organisationId->join('organisation_admins', 'organisations.id', '=', 'organisation_admins.id_organisation')->where('organisations.id', $organisationId->id)->first() ?? $organisationId,
        'adminInfo' => User::where('role', '!=','SAD')->get()
        ]);
    }
    public function postOrganisation(Request $request, Organisation $organisationId){
        $validatedData = $request->validate([
            'name' => ['required', 'max:255'],
            'verified' => ['required', 'in:Y,N'],
            'admin' => ['required'],
            'description' => ['max:255'],
                ]);
        $previousAdmin = OrganisationAdmin::where('id_organisation', $organisationId->id)->first();
        if ($previousAdmin != null) {
            User::where('id', $previousAdmin->id_user)->update(['role' => 'USR']);
            OrganisationAdmin::where('id_organisation', $organisationId->id)->update(['id_user' => $validatedData['admin']]);
        }  else {
            OrganisationAdmin::create([
                'id_admin' => Str::uuid(),
                'id_organisation' => $organisationId->id,
                'id_user' => $validatedData['admin']
            ]);
        }
        $organisationId->update([
            'name' => $validatedData['name'],
            'verified' => $validatedData['verified'],
            'description' => $validatedData['description'],
        ]);
        User::where('id', $validatedData['admin'])->update(['role' => 'OAD']);
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
        $previousAdmin = OrganisationAdmin::where('id_organisation', $organisationId->id)->first();
        User::where('id', $previousAdmin->id_user)->update(['role' => 'USR']);
        Card::where('id_organisation', $organisationId->id)->delete();
        $organisationId->delete();
        return redirect()->route('sad.organisations')->with('message', 'Organizacija je bila izbrisana!');
    }
}
