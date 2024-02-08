<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormValidator;
use App\Http\Requests\NewPasswordValidator;
use App\Http\Requests\PasswordResetFormValidator;
use App\Mail\PasswordResetLinkMail;
use App\Models\PasswordResets;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class PasswordResetController extends Controller
{

   public function getForm()
   {
       return view('passwordReset.PasswordReset', [
           'title' => 'Registracija',
           'existingData' => (object) [],
       ]);
   }


    public function resetPassword(PasswordResetFormValidator $request): RedirectResponse
    {
        $user = ($request->validated())['username'];
        $checkUser = User::whereUsername($user)->orWhere('email', '=',$user )->first();

        if ($checkUser) {
            $unique = uuid_create(0);
            $passwordResetURL = route('set-new-password', ['uid' => $checkUser->id, 'chk' => $unique]);
            PasswordResets::create([
                'id_user' => $checkUser->id,
                'requested_at' => time(),
                'expires' => (time() + 60 * 60),
                'chk' => $unique
            ]);
            Mail::to($checkUser->email)->send(new PasswordResetLinkMail($passwordResetURL, $checkUser->name, $checkUser->surname));
        }
        return redirect()->route('home')->with('message', "Če uporabnik obstaja, bo na pripadajoč e-poštni naslov ".
            "navodila za ponastavitev gesla");
    }

    public function getNewPasswordForm(Request $request)
    {
        if ($request->input('chk') !== null && $request->input('uid') !== null) {
            $chk = $request->input('chk');
            $uid = $request->input('uid');

            $checkURL = PasswordResets::whereIdUser($uid)->where('chk', '=', $chk)->count();

            if ($checkURL) {
                return view('passwordReset.SetPassword', [
                    'existingData' => (object) []
                ]);
            } else {
                return redirect()->route('home')->withErrors([
                    'username' => 'Povezava je potekla ali pa je že bila uporabljena'
                ]);
            }
        }
        return redirect()->route('home')->withErrors([
            'username' => 'Neveljavna povezava.'
        ]);
    }
    function isValidPassword($password)
    {
        $hasUppercase = preg_match('/[A-Z]/', $password);
        $hasLowercase = preg_match('/[a-z]/', $password);
        $hasNumber = preg_match('/\d/', $password);
        $hasSpecialCharacter = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password);
        $hasMinimumLength = strlen($password) >= 8;

        return $hasUppercase && $hasLowercase && $hasNumber && $hasSpecialCharacter && $hasMinimumLength;
    }
    public function setNewPassword(NewPasswordValidator $request)
    {
        $uid = $request->input('uid');
        $passwords = $request->validated();
        if ($this->isValidPassword($passwords['password'])) {
            if ($passwords['password'] == $passwords['password2']){
                $new_password = $passwords['password'];
                $checkPass = User::whereId($uid)->first();
                if (Hash::check($new_password, $checkPass)){
                    return back()->withErrors([
                        'password' => 'Novo gelso ne sme biti enako kot staro geslo!'
                    ]);
                } else {
                    User::whereId('uid')->update(['password' => Hash::make($new_password)]);
                    PasswordResets::whereIdUser($uid)->delete();
                }
            }
        } else {
            return back()->withErrors([
                'password' => "Geslo mora vsebovati vsaj 1 veliko črko, 1 številko in 1 poseben znak!"
            ]);
        }
        return back()->withErrors([
            'password' => "Gesli se ne ujemata!"
        ]);
    }
}
