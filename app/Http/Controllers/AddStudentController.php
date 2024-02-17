<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateValidator;
use App\Models\Classes;
use App\Models\OrganisationAdmin;
use App\Models\Students;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use App\Models\UserCard;
use Illuminate\Support\Facades\Hash;

class AddStudentController extends Controller
{
    public function getUsers()
    {
        $organisationId = OrganisationAdmin::whereIdUser(session('user')['id'])->first();
        return view(
            'organisation_admin.users.students',
            [
                'title' => 'Uporabniki',
                'data' => Students::where('students.id_organisation', '=', $organisationId->id_organisation)->join('users', 'users.id', '=', 'students.id_user')->get()
            ]
        );
    }

    public function getStudent(Request $request, User $userId)
    {
        $organisationId = OrganisationAdmin::whereIdUser(session('user')['id'])->first();
        $userData = Students::whereIdUser($userId->id)->join('users', 'users.id', '=', 'students.id_user')->get();
        $cards = Card::whereIdOrganisation($organisationId->id_organisation)->get();
        $userCards = UserCard::where('id_user', $userId->id)->join('cards', 'user_cards.id_card', '=', 'cards.id')->get();
        $userCardsArray = [];
        if ($userCards->count() != 0) {

            foreach ($userCards as $card) {
                $userCardsArray[$card->name] = $card->id_card;
            }
        }
        $class  = Classes::where('id_organisation', '=', $organisationId->id_organisation)->get();
        return view(
            'organisation_admin.users.studentAdd',
            [
                'title' => 'Uporabnik',
                'existingDataa' => (object) $userData,
                'cardInfo' => $cards,
                'userCards' => $userCardsArray,
                'existingData' => $userId,
                'roles' => ['STU'],
                'class' => (object) $class
            ]
        );
    }

    public function postUpdateStudent(UserCreateValidator $request, User $userId)
    {
        $validated = $request->validated();
        if ($request->username != $userId->username) {
            $validatedUsername = $request->validate([
                'username' => ['required', 'max:255', 'unique:users'],
            ]);
            $userId->update([
                'username' => $validatedUsername['username'],
            ]);

        }
        if ($request->email != $userId->email) {
            $validatedEmail = $request->validate([
                'email' => ['required', 'email', 'max:255', 'unique:users'],
            ]);
            $userId->update([
                'email' => $validatedEmail['email'],
            ]);
        }
        $userId->update([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'role' => $validated['role'],
        ]);


        $selectedCards = $request->input('cards');
        $userCards = UserCard::where('id_user', $userId->id)->get();
        foreach ($userCards as $userCard) {
            if($selectedCards != null) {
                if (!in_array($userCard->id_card, $selectedCards)) {
                    $userCard->delete();
                }
            } else {
                UserCard::where('id_user', '=', $userId->id)->delete();
            }

        }
        if ($selectedCards != null) {
            foreach ($selectedCards as $selectedCard) {
                if (!in_array($selectedCard, $userCards->pluck('id_card')->toArray())) {
                    $userCard = new UserCard([
                        'id_user' => $userId->id,
                        'id_card' => $selectedCard,
                    ]);
                    $userCard->save();
                }
            }
        }

        return redirect()->route('organisation_admin.students')->with('message', 'Podatki o uporabniku so bili posodobljeni!');
    }

    public function getAddStudent(Request $request, User $userId)
    {
        $organisationId = OrganisationAdmin::whereIdUser(session('user')['id'])->first()->id_organisation;
        $cards = Card::where('id_organisation', '=', $organisationId)->get();
        $classes = Classes::where('id_organisation', '=', $organisationId)->get();
        return view(
            'organisation_admin.users.studentAdd',
            [
                'title' => 'Dodaj dijaka/študenta',
                'cardInfo' => (object) $cards,
                'existingData' => $userId,
                'roles' => ['STU'],
                'class' => (object) $classes
            ]
        );
    }

    public function postAddStudent(Request $request, User $userId)
    {
        $admin = OrganisationAdmin::whereIdUser(session('user')['id'])->first()->id_admin;
        $organisationId = OrganisationAdmin::whereIdUser(session('user')['id'])->first()->id_organisation;
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'surname' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'username' => ['required', 'max:255', 'unique:users'],
            'emso' => ['required', 'numeric', 'unique:users', 'digits:13'],
            'role' => ['required'],
        ]);
        $user = new User([
            'name' => $validated['name'],
            'surname' => $validated['surname'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['emso']),
            'emso' => $validated['emso'],
            'role' => $validated['role'],
        ]);
        $user->save();
        $selectedCards = $request->input('cards');
        $selectedClass = $request->input('class');
        foreach ($selectedCards as $selectedCard) {
            $userCard = new UserCard([
                'id_user' => $user->id,
                'id_card' => $selectedCard,
            ]);
            $userCard->save();
            if (!(Students::where('id_user', $user->id)->where('id_organisation', '=', $organisationId)->exists())) {
                $student = new Students([
                    'id_user' => $user->id,
                    'id_organisation' => $organisationId,
                    'id_class' => $selectedClass,
                    'verified_by' => $admin
                ]);
                $student->save();
            }
        }
        return redirect()->route('organisation_admin.students')->with('message', 'Uporabnik ustvarjen!');
    }

    public function deleteUser(Request $request, User $userId)
    {
        UserCard::where('id_user', $userId->id)->delete();
        Students::where('id_user', $userId->id)->delete();
        Teacher::where('id_user', $userId->id)->delete();
        $userId->delete();
        return redirect()->route('organisation_admin.students')->with('message', 'Uporabnik je izbrisan!');
    }

}
