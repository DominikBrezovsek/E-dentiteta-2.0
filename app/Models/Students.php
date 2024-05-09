<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Students extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id_user',
        'id_organisation',
        'id_class',
        'verified_by',
    ];

    public static function getAllStudents($organisationId){
        return Students::select('users.name AS name','users.surname', 'users.email', 'users.emso', 'classes.name AS userClass')
            ->join('users', 'users.id', '=', 'students.id_user')
            ->join('classes', 'classes.id', '=', 'students.id_class')
            ->where('students.id_organisation', $organisationId)->get();
    }

    public static function updateByEmso($organisationId, $request){
        $classId = Classes::where('name', $request['userClass'])->first();

       $user =  Students::select('users.name AS name','users.surname', 'users.email', 'users.emso', 'students.id_class', 'users.id AS uid')
            ->where('students.id_organisation', $organisationId)
            ->where('users.emso', '=', $request['emso'])
            ->join('users', 'users.id', '=', 'students.id_user')
            ->join('classes', 'classes.id', '=', 'students.id_class')
            ->first();
       DB::beginTransaction();
       User::where('users.id', $user->uid)
        ->update([
           'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
        ]);
       Students::where('id_user', $user->uid)
           ->update([
               'id_class' => $classId->id,
           ]);
       DB::commit();

    }

    public static function deleteByEmso($emso)
    {
        $user = User::where('users.emso', $emso)->first();
        Students::where('students.id_user', $user->id)->delete();
        $user->delete();
    }

    public static function createStudent($request, $organisationId, $oad_id){
        DB::beginTransaction();
        $user = new User();
        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->email = $request['email'];
        $user->emso = $request['emso'];
        $user->password = Hash::make($request['password']);
        $user->username = $request['username'];
        $user->role = 'STU';
        $user->save();

        $student = new Students();
        $student->id_user = $user->id;
        $student->id_organisation = $organisationId;
        $student->id_class = $request['userClass'];
        $student->verified_by = $oad_id;
        $student->save();
        DB::commit();
    }
}
