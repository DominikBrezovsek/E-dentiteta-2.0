<?php

namespace App\Http\Controllers;

use App\Models\OrganisationAdmin;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Organisation;

class AddCardController extends Controller
{
    public function getCards()
    {
        $oid = OrganisationAdmin::whereIdUser(session('user')['id'])->first()->id_organisation;
        session()->put('oid', $oid);
       // session('user')->put('oid', $oid);
        return view('organisation_admin.cards.cards',
            [
                'title' => 'Kartice',
                'data' => Card::whereIdOrganisation($oid)->get()
            ]
        );
    }
    public function getCard(Request $request, Card $cardId)
    {
        return view('organisation_admin.cards.card',
            [
                'title' => 'Kartica',
                'existingData' => $cardId,
                'orgInfo' => Organisation::whereId(session('oid'))->get(),
            ]);
    }
    public function postCard(Request $request, Card $cardId)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['max:255'],
            'organisation' => ['required'],
            'auto_join' => ['required', 'in:Y,N'],
        ]);

        $cardId->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'id_organisation' => $validated['organisation'],
            'auto_join' => $validated['auto_join'],
        ]);
        return redirect()->route('organisation_admin.cards')->with('message', 'Podatki o kartici so bili posodobljeni!');
    }
    public function getAddCard(Request $request, Card $cardId)
    {
        return view('organisation_admin.cards.cardAdd',
            [
                'title' => 'Dodaj kartico',
                'existingData' => $cardId,
                'orgInfo' => Organisation::whereId(session('oid'))->get(),
            ]);
    }
    public function postAddCard(Request $request, Card $cardId)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['max:255'],
            'organisation' => ['required'],
            'auto_join' => ['required', 'in:Y,N'],
        ]);

        $card = new Card([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'id_organisation' => $validated['organisation'],
            'auto_join' => $validated['auto_join'],
        ]);
        $card->save();
        return redirect()->route('organisation_admin.cards')->with('message', 'Katrica ustvarjena!');
    }
    public function deleteCard(Request $request, Card $cardId)
    {
        $cardId->delete();
        return redirect()->route('organisation_admin.cards')->with('message', 'Kartica je izbrisana!');
    }
}
