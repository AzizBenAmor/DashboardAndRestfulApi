<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EvenementUpdateRequest extends FormRequest
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
            'titreU'=>'required',
            'dateDebutU'=>'required|date',
            'dateFinU'=>'required|date|after:dateDebut',
            'descriptionU'=>'required',
             'photoU'=>'nullable|mimes:png,jpg'
        ];
    }
    public function messages(): array
{
    return [
        'titreU.required' => 'Le champ titre est requis.',
        'dateDebutU.required' => 'Le champ date de début est requis.',
        'dateDebutU.date' => 'Le champ date de début doit être une date valide.',
        'dateFinU.required' => 'Le champ date de fin est requis.',
        'dateFinU.required' => 'Le champ date de fin est requis.',
        'dateFinU.date' => 'Le champ date de fin doit être une date valide.',
        'dateFinU.after' => 'Le champ date de fin doit être postérieur à la date de début.',
        'descriptionU.required' => 'Le champ description est requis.',
        'photoU.nullable' => 'Le champ photo est facultatif.',
        'photoU.mimes' => 'Le champ photo doit être au format PNG ou JPG.',
    ];
}

}
