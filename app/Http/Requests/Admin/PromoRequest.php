<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PromoRequest extends FormRequest
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
            'titre'=>'required',
            'dateDebut'=>'required|date',
            'dateFin'=>'required|date|after:dateDebut',
            'description'=>'required'
        ];
    }
    public function messages(): array
{
    return [
        'titre.required' => 'Le champ titre est requis.',
        'dateDebut.required' => 'Le champ date de début est requis.',
        'dateDebut.date' => 'Le champ date de début doit être une date valide.',
        'dateFin.required' => 'Le champ date de fin est requis.',
        'dateFin.date' => 'Le champ date de fin doit être une date valide.',
        'dateFin.after' => 'La date de fin doit être postérieure à la date de début.',
        'description.required' => 'Le champ description est requis.',
    ];
}

}
