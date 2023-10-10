<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id_card';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_organisation',
        'name',
        'description',
    ];

    // Relationships
    public function organisation()
    {
        return $this->belongsTo(Organisation::class, 'id_organisation');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cards', 'id_card', 'id_user');
    }
}

