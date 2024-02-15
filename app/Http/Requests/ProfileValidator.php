<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileValidator extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime uporabnika je obvezno',
            'surname.required' => 'Priimek uporabnika je obvezen'
        ];
    }
}
