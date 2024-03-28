<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCardValidator;
use App\Models\OrganisationAdmin;
use App\Models\Teacher;
use App\Models\UserCard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Organisation;
use App\Models\RequestCard;

class ProfessorCardsController extends Controller
{
    public function getCards()
    {
        $userId = session('user')['id'];
        $organisationId =Teacher::whereIdUser($userId)->first()->id_organisation;
        $cards = Card::where('id_organisation', '=', $organisationId)->paginate(5);

        return view(
            'professor.card.cards',
            [
                'title' => 'Kartice organizacije',
                'data' => $cards,
            ]
        );
    }

    public function getCard(Request $request, Card $cardId)
    {
        return view('professor.card.card',
            [
                'title' => 'Kartica',
                'existingData' => $cardId,
            ]);
    }

    public function postCard(AddCardValidator $request, Card $cardId) : RedirectResponse
    {
        $validated = $request->validated();

        $cardId->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'auto_join' => $validated['auto_join'],
        ]);
        return redirect()->route('professor.cards')->with('message', 'Podatki o kartici so bili posodobljeni!');
    }
    public function getApproveCards()
    {
        $userId = session('user')['id'];
        $organisationId = Teacher::whereIdUser($userId)->first()->id_organisation;
        $data = Card::whereIdOrganisation($organisationId)
            ->select(['users.name AS user_name', 'users.surname AS user_surname', 'users.email AS user_email', 'users.emso AS user_emso',  'cards.name AS card_name','cards.id AS cid',  'request_card.id AS rid'])
            ->join('request_card', 'request_card.id_card', '=', 'cards.id')
            ->join('users', 'users.id', '=', 'request_card.id_user')->get();
        return view('professor.card.cardApprove',
            [
                'title' => 'Potrdi kartico',
                'data' => $data,
            ]);
    }

    public function getApproveCard(Request $request, RequestCard $requestId)
    {
        $idCard = $requestId->id_card;
        $idUser = $requestId->id_user;
        RequestCard::whereId($requestId->id)->delete();
        $userCard = new UserCard([
            'id_card' => $idCard,
            'id_user' => $idUser,
        ]);
        $userCard->save();
        return redirect()->route('professor.card.approve')->with('message', 'Kartica je bila potrjena!');

    }
    public function getDeclineCard(Request $request, RequestCard $requestId)
    {
        RequestCard::whereId($requestId->id)->delete();
        return redirect()->route('professor.card.approve')->with('message', 'Kartica je bila zavrnjena!');
    }
}
