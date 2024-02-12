<?php

namespace App\Http\Controllers;

use App\Models\OrganisationEmployees;
use App\Models\OrganisationUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organisation;
class AddUserOrganisationController extends Controller
{
    public function getUsers()
    {
        return view('organisation.user.users',
            [
                'data' => OrganisationUser::where('id_organisation', '=', Organisation::where('id_user', session('user')->id)->first()->id)->join('users', 'organisaton_users.id_user', '=', 'users.id')->paginate(5),
                'title' => 'Uporbaniki organizacije'
            ]
        );
    }

    public function getAddUser()
    {
        return view('organisation.user.userAdd',
            [
                'data' => User::where('role', 'USR')->whereNot('id', session('user')->id)->whereNotIn('id', OrganisationEmployees::select('id_user')
                    ->where('id_organisation', Organisation::where('id_user', session('user')->id)->first()->id)
                )
                ->paginate(5),
                'title' => 'Dodaj uporabnika'
            ]
        );
    }

    public function postAddUser(Request $request, User $userId)
    {
        OrganisationUser::create([
            'id_organisation' => Organisation::where('id_user', session('user')->id)->first()->id,
            'id_user' => $userId->id
        ]);
        return redirect()->route('organisation.users')->with('message', 'Uporabnik uspešno dodan!');
    }

    public function deleteUser(Request $request, User $userId)
    {
        OrganisationUser::where('id_user', $userId->id)->delete();
        return redirect()->route('organisation.users')->with('message', 'Uporabnik uspešno odstranjen!');
    }
}
