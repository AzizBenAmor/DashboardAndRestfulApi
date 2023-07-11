<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PartenaireStoreRequest extends FormRequest
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
            'gov_id'=>'required',
            'email'=>'required|email|unique:partenaires,email',
            'ville_id'=>'required',
            'secteur_id'=>'required',
            'profession_id'=>'required',
            'specialite_id'=>'required',
            'nom'=>'required|regex:/^[\pL\s\'é]+$/u',
            'nom_responsable'=>'required|regex:/^[\pL\s\'é]+$/u',
            'adress'=>'required',
            'numero'=>'required|numeric|digits:8', 
            'cin'=>'required|numeric|digits:8|unique:partenaires,cin',
            'photo'=>'required|file|mimes:jpg,png'
        ];
    }
    public function messages(): array
{
    return [
        'gov_id.required' => 'Le champ gouvernorat est requis.',
        'email.required' => 'Le champ email est requis.',
        'email.email' => 'Le champ email doit être une adresse email valide.',
        'email.unique' => 'Cette adresse email est déjà utilisée par un autre partenaire.',
        'ville_id.required' => 'Le champ ville est requis.',
        'secteur_id.required' => 'Le champ secteur est requis.',
        'profession_id.required' => 'Le champ profession est requis.',
        'specialite_id.required' => 'Le champ spécialité est requis.',
        'nom.required' => 'Le champ nom est requis.',
        'nom.alpha' => 'Le champ nom ne doit contenir que des lettres.',
        'nom_responsable.required' => 'Le champ nom du responsable est requis.',
        'nom_responsable.alpha' => 'Le champ nom du responsable ne doit contenir que des lettres.',
        'adress.required' => 'Le champ adresse est requis.',
        'numero.required' => 'Le champ numéro est requis.',
        'numero.numeric' => 'Le champ numéro doit être un nombre.',
        'numero.digits' => 'Le champ numéro doit contenir :8 chiffres.',
        'cin.required' => 'Le champ CIN est requis.',
        'cin.numeric' => 'Le champ CIN doit être un nombre.',
        'cin.digits' => 'Le champ CIN doit contenir :8 chiffres.',
        'cin.unique' => 'Ce numéro de CIN est déjà utilisé par un autre partenaire.',
        'photo.required' => 'Le champ photo est requis.',
        'photo.file' => 'Le champ photo doit être un fichier.',
        'photo.mimes' => 'Le champ photo doit être au format JPG ou PNG.',
    ];
}

}
