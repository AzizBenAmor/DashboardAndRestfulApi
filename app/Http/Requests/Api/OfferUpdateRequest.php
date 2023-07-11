<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class OfferUpdateRequest extends FormRequest
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
            'nom'=>'required',
            'description'=>'required',
            'adress'=>'required',
            'reduction'=>'required|integer|between:0,100',
            'prix'=>'required|numeric',
            'dateDebut'=>'required|date',
            'dateFin'=>'required|date|after:dateDebut', 
            'photo'=>'nullable|mimes:jpg,png',
            'tel'=>'required|numeric|digits:8'
        ];
    }
    public function messages(): array
{
    return [
        'nom.required' => 'Le champ nom est requis.',
        'description.required' => 'Le champ description est requis.',
        'adress.required' => 'Le champ adresse est requis.',
        'reduction.required' => 'Le champ réduction est requis.',
        'reduction.integer' => 'Le champ réduction doit être un entier.',
        'reduction.between' => 'Le champ réduction doit être compris entre :0 et :100.',
        'prix.required' => 'Le champ prix est requis.',
        'prix.numeric' => 'Le champ prix doit être un nombre.',
        'dateDebut.required' => 'Le champ date de début est requis.',
        'dateDebut.date' => 'Le champ date de début doit être une date valide.',
        'dateFin.required' => 'Le champ date de fin est requis.',
        'dateFin.date' => 'Le champ date de fin doit être une date valide.',
        'dateFin.after' => 'Le champ date de fin doit être postérieure à la date de début.',
        'photo.mimes' => 'Le fichier doit être de type JPG ou PNG.',
        'tel.required' => 'Le champ téléphone est requis.',
        'tel.numeric' => 'Le champ téléphone doit être un nombre.',
        'tel.digits' => 'Le champ téléphone doit contenir :8 chiffres.',
    ];
}
}
