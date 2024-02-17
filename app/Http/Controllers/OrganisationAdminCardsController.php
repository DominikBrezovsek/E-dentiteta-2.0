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

class OrganisationAdminCardsController extends Controller
{

    public function getApproveCards()
    {
        $userId = session('user')['id'];
        $organisationId = OrganisationAdmin::whereIdUser($userId)->first()->id_organisation;
        $data = Card::whereIdOrganisation($organisationId)
            ->select(['users.name AS user_name', 'users.surname AS user_surname', 'users.email AS user_email', 'users.emso AS user_emso',  'cards.name AS card_name','cards.id AS cid',  'request_card.id AS rid'])
            ->join('request_card', 'request_card.id_card', '=', 'cards.id')
            ->join('users', 'users.id', '=', 'request_card.id_user')->get();
        return view('organisation_admin.cards.cardApprove',
            [
                'title' => 'Potrdi kartico',
                'data' => $data,
            ]);
    }

    public function getApproveCard(Request $request, RequestCard $requestId)
    {
        $idCard = $requestId->id_card;
        $idUser = $requestId->id_user;
        $userCard = new UserCard([
            'id_card' => $idCard,
            'id_user' => $idUser,
        ]);
        $userCard->save();
        RequestCard::whereId($requestId->id)->delete();
        return redirect()->route('organisation_admin.cards.approve')->with('message', 'Kartica je bila potrjena!');

    }
    public function getDeclineCard(Request $request, RequestCard $requestId)
    {
        RequestCard::whereId($requestId->id)->delete();
        return redirect()->route('organisation_admin.cards.approve')->with('message', 'Kartica je bila zavrnjena!');
    }
}
