<?php

namespace App\Http\Controllers;

use App\Models\OrganisationEmployees;
use App\Models\OrganisationUser;
use App\Models\Students;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organisation;
class AddUserOrganisationController extends Controller
{
    public function getUsers()
    {
        $classId = Teacher::whereIdUser(session('user')['id'])->join('classes', 'teachers.id', '=', 'classes.id_teacher')->first();
        return view('professor.user.users',
            [
                'data' => Students::where('id_class', '=', $classId->id)->join('users', 'users.id', '=', 'students.id_user')->get(),
                'title' => 'Uporbaniki organizacije'
            ]
        );
    }

    public function getAddUser()
    {
        return view('organisation.student.userAdd',
            [
                'data' => User::where('role', 'USR')->whereNot('id', session('student')->id)->whereNotIn('id', OrganisationEmployees::select('id_user')
                    ->where('id_organisation', Organisation::where('id_user', session('student')->id)->first()->id)
                )
                ->paginate(5),
                'title' => 'Dodaj uporabnika'
            ]
        );
    }

    public function postAddUser(Request $request, User $userId)
    {
        OrganisationUser::create([
            'id_organisation' => Organisation::where('id_user', session('student')->id)->first()->id,
            'id_user' => $userId->id
        ]);
        return redirect()->route('professor.users')->with('message', 'Uporabnik uspešno dodan!');
    }

    public function deleteUser(Request $request, User $userId)
    {
        OrganisationUser::where('id_user', $userId->id)->delete();
        return redirect()->route('professor.users')->with('message', 'Uporabnik uspešno odstranjen!');
    }
}
