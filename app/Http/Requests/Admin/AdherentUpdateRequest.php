<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdherentUpdateRequest extends FormRequest
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
            'amicale_idU'=>'nullable',
            'nomU'=>'required|regex:/^[\pL\s\'é]+$/u',
          'adressU'=>'required',
          'telU'=>'required|numeric|digits:8',
            'carte_idU'=>'nullable|unique:adherents,carte_id'
        ];
    }
    public function messages(): array
{
    return [
        'amicale_idU.nullable' => 'Le champ amicale est facultatif.',
        'nomU.required' => 'Le champ nom est requis.',
        'adressU.required' => 'Le champ adresse est requis.',
        'telU.required' => 'Le champ téléphone est requis.',
        'telU.numeric' => 'Le champ téléphone doit être un nombre.',
        'telU.digits' => 'Le champ téléphone doit contenir :digits chiffres.',
        'carte_idU.nullable' => 'Le champ carte est facultatif.',
        'carte_idU.unique' => 'Cette carte est déjà utilisée par un autre adhérent.',
    ];
}
}
