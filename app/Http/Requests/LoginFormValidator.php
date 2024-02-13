<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormValidator extends FormRequest
{
    /**
     * @var bool
     * stop validation of the request on first fail
     */
    protected $stopOnFirstFailure = true;
    /**
     * Determine if the user is authorized to make this request.
     * Set to true, because at login we don't expect user to be validated.
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
            'username' => 'required|string',
            'password' => 'required'
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
            'username.required' => 'Uporabniško ime je obvezen podatek',
            'password.required' => 'Geslo je obvezen podatek!'
        ];
    }
}
