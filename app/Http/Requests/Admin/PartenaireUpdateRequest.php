<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartenaireUpdateRequest extends FormRequest
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
            'nomU'=>'required|regex:/^[\pL\s\'é]+$/u',
            'nom_responsableU'=>'required|regex:/^[\pL\s\'é]+$/u',
            'numeroU'=>'required|numeric|digits:8',
            'adressU'=>'required',
            'photoU'=>'nullable|file|mimes:jpg,png'
        ];
    }
    public function messages(): array
{
    return [
        'nomU.required' => 'Le champ nom est requis.',
        'nomU.regex' => 'Le champ nom ne doit contenir que des lettres.',
        'nom_responsableU.required' => 'Le champ nom du responsable est requis.',
        'nom_responsableU.regex' => 'Le champ nom du responsable ne doit contenir que des lettres.',
        'numeroU.required' => 'Le champ numéro est requis.',
        'numeroU.numeric' => 'Le champ numéro doit être un nombre.',
        'numeroU.digits' => 'Le champ numéro doit contenir :8 chiffres.',
        'adressU.required' => 'Le champ adresse est requis.',
        'photoU.nullable' => 'Le champ photo est facultatif.',
        'photoU.file' => 'Le champ photo doit être un fichier.',
        'photoU.mimes' => 'Le champ photo doit être au format JPG ou PNG.',
    ];
}

}
