<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'id_teacher',
        'id_card',
        'id_organisation'
    ];

    public static function getAllClasses($organisation){
        return Classes::where('id_organisation', $organisation)->get();
    }
}
