<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdherentStoreRequest extends FormRequest
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
            'nom'=>'required|regex:/^[\pL\s\'é]+$/u',
            'email'=>'required|email|unique:adherents,email',
            'gov_id'=>'required|exists:gouvernorats,id',
            'ville_id'=>'required|exists:villes,id',
            'carte_id'=>'required|exists:cartes,id',
            'adress'=>'required',
            'tel'=>'required|numeric|digits:8',
            'cin'=>'required|numeric|digits:8'
        ];
    }

    public function messages(): array
{
    return [
        'nom.required' => 'Le champ nom est requis.',
        'nom.alpha' => 'Le champ nom ne doit contenir que des lettres.',
        'email.required' => 'Le champ email est requis.',
        'email.email' => 'Le champ email doit être une adresse email valide.',
        'email.unique' => 'Cette adresse email est déjà utilisée.',
        'gov_id.required' => 'Le champ gouvernorat est requis.',
        'gov_id.exists' => 'Le gouvernorat sélectionné n\'existe pas.',
        'ville_id.required' => 'Le champ ville est requis.',
        'ville_id.exists' => 'La ville sélectionnée n\'existe pas.',
        'carte_id.required' => 'Le champ carte est requis.',
        'carte_id.exists' => 'La carte sélectionnée n\'existe pas.',
        'adress.required' => 'Le champ adresse est requis.',
        'tel.required' => 'Le champ téléphone est requis.',
        'tel.numeric' => 'Le champ téléphone doit être un nombre.',
        'tel.digits' => 'Le champ téléphone doit contenir :digits chiffres.',
        'cin.required' => 'Le champ CIN est requis.',
        'cin.numeric' => 'Le champ CIN doit être un nombre.',
        'cin.digits' => 'Le champ CIN doit contenir :digits chiffres.',
    ];
}
}
