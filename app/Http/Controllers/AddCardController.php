<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\Organisation;

class AddCardController extends Controller
{
    public function getCards()
    {
        return view('organisation_admin.cards.cards',
            [
                'title' => 'Kartice',
                'data' => Card::all()
            ]
        );
    }
    public function getCard(Request $request, Card $cardId)
    {
        return view('organisation_admin.cards.card',
            [
                'title' => 'Kartica',
                'existingData' => $cardId,
                'orgInfo' => Organisation::all(),
            ]);
    }
    public function postCard(Request $request, Card $cardId)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['max:255'],
            'professor' => ['required'],
            'auto_join' => ['required', 'in:Y,N'],
        ]);

        $cardId->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'id_organisation' => $validated['professor'],
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
                'orgInfo' => Organisation::all(),
            ]);
    }
    public function postAddCard(Request $request, Card $cardId)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['max:255'],
            'professor' => ['required'],
            'auto_join' => ['required', 'in:Y,N'],
        ]);

        $card = new Card([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'id_organisation' => $validated['professor'],
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
