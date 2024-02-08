<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'string|required|min:8|regex:/[a-z]//[A-Z]//\d//[!@#$%^&*(),.?":{}|<>]/',
            'password2' => 'string|required|min:8|regex:/[a-z]//[A-Z]//\d//[!@#$%^&*(),.?":{}|<>]/',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Geslo je obvezen podatek!',
            'password.min' => 'Geslo mora vsebovati vsaj 8 znakov',
            'password.regex' =>'Geslo mora vsebovati vsaj 1 veliko črko, 1 števiklo in 1 poseben znak!',
            'password2.required' => 'Ponovno vnesite geslo!',
        ];
    }
}
