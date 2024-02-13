<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterFormValidator;
use App\Models\User;
use App\View\Components\input;
use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function getRegister()
    {
        return view('register.registerForm', [
            'title' => 'Registracija',
            'existingData' => (object) [],
        ]);
    }
    public function postRegister(RegisterFormValidator $request): RedirectResponse
    {

        $credentials = $request->validated();

        function isValidPassword($password)
        {
            $hasUppercase = preg_match('/[A-Z]/', $password);
            $hasLowercase = preg_match('/[a-z]/', $password);
            $hasNumber = preg_match('/\d/', $password);
            $hasSpecialCharacter = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
            $hasMinimumLength = strlen($password) >= 8;

            return $hasUppercase && $hasLowercase && $hasNumber && $hasSpecialCharacter && $hasMinimumLength;
        }

        if (!isValidPassword($credentials['password'])) {
            return back()->withErrors([
                'password' => 'Geslo mora vsebovati vsaj 8 znakov, eno veliko črko, eno malo črko, eno številko in en poseben znak.',
            ])->onlyInput('username', 'email', 'name', 'surname', 'emso');
        }

        if ($credentials['password'] != $credentials['password2']) {
            return back()->withErrors([
                'password' => 'Gesli se ne ujemata.',
            ])->onlyInput('username', 'email', 'name', 'surname', 'emso');
        }

        if (strlen($credentials['emso']) != 13) {
            return back()->withErrors([
                'emso' => 'EMŠO ni pravilne dolžine (13 znakov).',
            ])->onlyInput('username', 'email', 'name', 'surname', 'password', 'password2');
        }

        $user = new User();
        $user->username = $credentials['username'];
        $user->password = Hash::make($credentials['password']);
        $user->email = $credentials['email'];
        $user->name = $credentials['name'];
        $user->surname = $credentials['surname'];
        $user->emso = $credentials['emso'];

        $user->save();

        return redirect()->route('home')->with('message', 'Registracija uspešna!');
    }
}
