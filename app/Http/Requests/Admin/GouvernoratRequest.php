<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GouvernoratRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'nom'=>'required|regex:/^[\pL\s\'é]+$/u|unique:gouvernorats,nom'
        ];
    }
    public function messages(): array
{
    return [
        'nom.required' => 'Le champ nom est requis.',
        'nom.regex' => 'Le champ nom ne doit contenir que des lettres.',
        'nom.unique' => 'Ce nom de gouvernorat est déjà utilisé.',
    ];
}
}
