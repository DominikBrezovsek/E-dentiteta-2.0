<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;
    use HasUuids;

    
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'email_verified_at',
        'username',
        'password',
        'emso',
        'role',
    ];

    // Relationships
    public function organisations()
    {
        return $this->belongsToMany(Organisation::class, 'organisation_users', 'id_user', 'id_organisation');
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'user_cards', 'id_user', 'id_card');
    }
}

