<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordValidator extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $stopOnFirstFailure = true;
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
            'password' => 'required|min:8',
            'password2' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Geslo je obvezen podatek!',
            'password.min' => 'Geslo mora vsebovati vsaj 8 znakov',
            'password2.required' => 'Ponovno vnesite geslo!',
        ];
    }
}
