<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CardVerification extends Model
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'id';
    public $incrementing = 'false';
    protected $keyType = 'string';
    protected $fillable = [
        'id_user',
        'id_card',
        'check_seq',
        'expires',
        ];
}
