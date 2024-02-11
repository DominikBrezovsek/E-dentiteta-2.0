<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCardValidator extends FormRequest
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
            'name' => 'required|string',
            'description' => 'nullable',
            'auto_join' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Ime kartice je obvezno",
            'auto_join.required' => "Podatek o možnosti pristopa je obvezen!"
        ];
    }
}
