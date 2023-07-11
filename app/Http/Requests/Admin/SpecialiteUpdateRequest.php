<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SpecialiteUpdateRequest extends FormRequest
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
            'nomU'=>'required|regex:/^[\pL\s\'é()\/]+$/u|unique:specialites,nom'
        ];
    }
    public function messages(): array
{
    return [
        'nomU.required' => 'Le champ nom est requis.',
        'nomU.regex' => 'Le champ nom ne doit contenir que des lettres.',
        'nomU.unique' => 'Le nom spécifié existe déjà dans la base de données.',
    ];
}
}  