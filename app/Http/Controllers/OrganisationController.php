<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\OrganisationAdmin;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    function getOrganisation(){
        $oid = OrganisationAdmin::whereIdUser(session('user')['id'])->first()->id_organisation;
        $orgData = Organisation::whereId($oid)->first();
        return view('organisation_admin.organisation.organisation', [
            'organisationData' =>$orgData
        ]);
    }
}
