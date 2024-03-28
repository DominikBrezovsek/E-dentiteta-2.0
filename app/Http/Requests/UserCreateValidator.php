<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateValidator extends FormRequest
{
    /**
     * Determine if the student is authorized to make this request.
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
            'name' => 'required|max:225',
            'surname' => 'required|max:225',
            'role' => 'required|in:STU, PRF, OAD, SAD, VEN ',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime uporabnika je obvezno.',
            'surname.required' => 'Priimek uporabnika je obvezno.',
            'role.in' => 'Vloga uporabnika ni pravilna!'
        ];

    }
}
