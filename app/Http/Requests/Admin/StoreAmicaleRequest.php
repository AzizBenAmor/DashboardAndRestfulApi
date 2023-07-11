<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmicaleRequest extends FormRequest
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
         
                'photo'=>'required|file|mimes:jpg,png',
                'nom'=>'required|regex:/^[\pL\s\'é]+$/u',
                'nom_responsable'=>'required|regex:/^[a-zA-Z\s]+$/',
                'email'=>'required|email|unique:amicales,email',
                'numero'=>'required|numeric|digits:8',
                'gov_id'=>'required',
                'ville_id'=>'required',
                'cin'=>'required|numeric|digits:8|unique:amicales,cin'
            
        ];
    }
    public function messages(): array
{
    return [
        'photo.required' => 'Le champ photo est requis.',
        'photo.file' => 'Le champ photo doit être un fichier.',
        'photo.mimes' => 'Le champ photo doit être au format JPG ou PNG.',
        'nom.required' => 'Le champ nom est requis.',
        'nom.regex' => 'Le champ nom ne doit contenir que des lettres.',
        'nom_responsable.required' => 'Le champ nom du responsable est requis.',
        'nom_responsable.regex' => 'Le champ nom du responsable ne doit contenir que des lettres.',
        'email.required' => 'Le champ email est requis.',
        'email.email' => 'Le champ email doit être une adresse email valide.',
        'email.unique' => 'Cette adresse email est déjà utilisée par une autre amicale.',
        'numero.required' => 'Le champ numéro est requis.',
        'numero.numeric' => 'Le champ numéro doit être un nombre.',
        'numero.digits' => 'Le champ numéro doit contenir :8 chiffres.',
        'gov_id.required' => 'Le champ gouvernorat est requis.',
        'ville_id.required' => 'Le champ ville est requis.',
        'cin.required' => 'Le champ CIN est requis.',
        'cin.numeric' => 'Le champ CIN doit être un nombre.',
        'cin.digits' => 'Le champ CIN doit contenir :8 chiffres.',
        'cin.unique' => 'CIN est déjà utilisée par une autre amicale.',
    ];
}
}
