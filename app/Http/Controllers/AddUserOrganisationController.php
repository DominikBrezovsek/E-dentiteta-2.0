<?php

namespace App\Http\Controllers;

use App\Models\Classes;
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
        return view('professor.user.userAdd',
            [
                'data' => User::where('role', '=', 'USR')->paginate(5),
                'title' => 'Dodaj uporabnika'
            ]
        );
    }

    public function postAddUser(Request $request, User $userId)
    {
        $teacher = Teacher::whereIdUser(session('user')['id'])->first();
        $classId = Classes::whereIdTeacher($teacher->id)->first();
        Students::create([
            'id_organisation' => $teacher->id_organisation,
            'id_user' => $userId->id,
            'id_class' => $classId->id,
            'verified_by' => $teacher->id,
        ]);
        User::where('id', '=', $userId->id)->update(['role' => 'STU']);
        return redirect()->route('professor.users')->with('message', 'Uporabnik uspešno dodan!');
    }

    public function deleteUser(Request $request, User $userId)
    {
        Students::where('id_user','=', $userId->id)->delete();
        User::where('id', '=', $userId->id)->update(['role' => 'USR']);
        return redirect()->route('professor.users')->with('message', 'Uporabnik uspešno odstranjen!');
    }
}
