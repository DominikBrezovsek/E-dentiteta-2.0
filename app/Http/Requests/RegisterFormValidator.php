<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormValidator extends FormRequest
{
    /**
     * @var bool
     * stop validation of the request on first fail
     */
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the student is authorized to make this request.
     * Set to true, because at login we don't expect student to be validated.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Written in key => value pairs where key is the name of input and the value are validation attributes.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     *
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'surname' => 'required|string',
            'username' => 'required|string|unique:App\Models\User,username',
            'email' => 'required|email|unique:App\Models\User,email',
            'emso' => 'required|numeric|min_digits:13|max_digits:13|unique:App\Models\User,emso',
            'password' => 'required',
            'password2' => 'required',
        ];

    }

    /**
     *
     * Set custom error messages that are send to view when request is not valid
     * @return array<string, string>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Ime je obvezen podatek',
            'surname.required' => 'Priimek je obvezen podatek',
            'username.required' => 'Uporabniško ime je obvezen podatek',
            'username.unique' => 'Uporabniško ime že obstaja',
            'email.required' => 'E-poštni naslov je obvezen podatek',
            'email.unique' => 'E-poštni naslov že obstaja',
            'emso.required' => 'EMŠO je obvezen podatek',
            'emso.unique' => 'EMŠO že obstaja',
            'emso.min_digits' => 'EMŠO mora imeti natanko 13 številk',
            'emso.max_digits' => 'EMŠO mora imeti natanko 13 številk',
            'password.required' => 'Geslo je obvezen podatek!',
            'password2.required' => 'Potrditev gesla je obvezen podatek!'
        ];
    }
}
