<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use HasFactory;
    use HasUuids;

    
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    public function getAuthIdentifierName()
    {
        return 'id_user'; // Change this to your primary key column name if it's different
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password; // Change this to your password column name if it's different
    }

    public function getRememberToken()
    {
        return $this->remember_token; // Change this to your remember token column name if it's different
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value; // Change this to your remember token column name if it's different
    }

    public function getRememberTokenName()
    {
        return 'remember_token'; // Change this to your remember token column name if it's different
    }
    protected $rememberTokenName = false;
    protected $fillable = [
        'name',
        'surname',
        'email',
        'email_verified_at',
        'username',
        'password',
        'emso',
        'role'
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

