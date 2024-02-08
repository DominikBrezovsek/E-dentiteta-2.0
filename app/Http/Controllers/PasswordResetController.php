<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormValidator;
use App\Http\Requests\PasswordResetFormValidator;
use App\Mail\PasswordResetLinkMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
            Mail::to($checkUser)->send(new PasswordResetLinkMail());
        }
        return redirect()->route('home')->with('message', "Če uporabnik obstaja, bo na pripadajoč e-poštni naslov ".
            "navodila za ponastavitev gesla");
    }
}
