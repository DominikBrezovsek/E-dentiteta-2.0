<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
