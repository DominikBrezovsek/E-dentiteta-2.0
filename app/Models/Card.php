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
        return $this->belongsTo(Organisation::class, 'id_organisation');
    }

    // Card has many UserCards
    public function userCards()
    {
        return $this->hasMany(UserCard::class, 'id_card');
    }

    // Card has many RequestCards
    public function requestCards()
    {
        return $this->hasMany(RequestCard::class, 'id_card');
    }

    public static function getAllCards($organisationId) {
        return Card::select('cards.id', 'id_organisation', 'cards.name AS card_name', 'cards.description AS card_desc', 'auto_join', 'organisations.name AS organisation_name')
            ->where('id_organisation', $organisationId)
            ->join('organisations', 'id_organisation', 'organisations.id')->get();
    }

    public static function createCard($request,$organisationId) {
        $card = new Card();
        $card->name = $request['card_name'];
        $card->description = $request["description"];
        $card-> auto_join = $request["auto_join"];
        $card->organisation()->associate($organisationId);
        $card->save();
        return self::getAllCards($organisationId);
    }

    public static function updateById($request) {
        Card::where('id', $request['cardId'])
            ->update([
                'name' => $request['name'],
                'description' => $request['description'],
                'auto_join' => $request['auto_join'] == "Da" ? 'Y' : 'N',
            ]);

    }

    public static function deleteById($cardId) {
        Card::where('id', $cardId)->delete();
    }

}

