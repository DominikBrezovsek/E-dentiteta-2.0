<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\Teacher;
use App\Notifications\UserRequestedCardNotification;
use Carbon\Carbon;
use Couchbase\User;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\OrganisationUser;
use App\Models\UserCard;
use App\Models\RequestCard;
use Illuminate\Support\Facades\Notification;

class AddUserCardController extends Controller
{
    public function getCards()
    {
        return view(
            'student.card.cards',
            [
                'title' => 'Seznam kartic',
                'data' => UserCard::join('cards', 'cards.id', '=', 'user_cards.id_card')->where('id_user', session('user')['id'])->get(),
            ]
        );
    }

    public function getCard(Request $request, Card $cardId)
    {
        return view(
            'student.card.card',
            [
                'title' => 'Kartica ' . $cardId->name,
                'card' => $cardId,
            ]
        );
    }

    public function postCard(Request $request, Card $cardId)
    {
        // Logic for handling the "user.card.update" route (POST and PUT methods)
    }

    public function getAddCard()
    {
        $userId = session('user')['id'];
        $organisationId = Students::whereIdUser($userId)->first()->id_organisation;
        //TODO: You can make join with pivot points

        $cards = Card::whereDoesntHave('userCards', function ($query) use ($userId) {
            $query->where('id_user', $userId);
        })
            ->whereDoesntHave('requestCards', function ($query) use ($userId) {
                $query->where('id_user', $userId);
            })
            ->where('id_organisation', '=', $organisationId)
            ->get();

        return view(
            'student.card.cardJoin',
            [
                'title' => 'Dodaj kartico',
                'data' => $cards,
            ]
        );
    }

    public function postAddCard(Request $request, Card $cardId)
    {
        $userId = session('user')['id'];
        if ($cardId->auto_join == 'Y') {
            UserCard::create([
                'id_user' => $userId,
                'id_card' => $cardId->id,
            ]);
            return redirect()->route('student.card.join')->with('message', 'Kartica je bila dodana!');
        } else {
            RequestCard::insert([
                'id' => \Str::uuid(),
                'id_user' => $userId,
                'id_card' => $cardId->id,
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $teacher = \App\Models\User::select(['users.*', 'teachers.id AS tid'])->whereRole('PRF')->join('teachers', 'teachers.id_user', '=', 'users.id')->where('teachers.id_organisation', '=', $cardId->id_organisation)->get();
            Notification::send($teacher, new UserRequestedCardNotification(['cardId' => $cardId->id, 'userId' => $userId]));
            return redirect()->route('student.card.join')->with('message', 'Kartica je bila zahtevana!');
        }
    }

    public function deleteCard(Request $request, Card $cardId)
    {
        $userId = session('user')['id'];
        UserCard::where('id_user', $userId)->where('id_card', $cardId->id)->delete();
        return redirect()->route('student.cards')->with('message', 'Kartica je izbrisan!');
    }
}
