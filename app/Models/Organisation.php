<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisation extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'description',
        'verified',
        'logo'
    ];

    // Relationships
    public function cards()
    {
        return $this->hasMany(Card::class, 'id_organisation');
    }

    // Organisation has many RequestCards
    public function requestCards()
    {
        return $this->hasMany(RequestCard::class, 'id_organisation');
    }
}

