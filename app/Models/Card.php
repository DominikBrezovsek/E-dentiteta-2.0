<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_organisation',
        'name',
        'description',
        'auto_join',
    ];

    // Relationships
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cards', 'id_user', 'id_card');
    }
    public function userCards()
    {
        return $this->hasMany(UserCard::class, 'id_card', 'id');
    }

}

