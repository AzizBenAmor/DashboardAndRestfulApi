<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'photo'=>'required|mimes:png,jpg',
            'lien'=>'required|url',
            'description'=>'required',
            'dateDebut'=>'required|date',
        ];
    }
    public function messages(): array
{
    return [
        'nom.required' => 'Le champ nom est requis.',
        'photo.required' => 'Le champ photo est requis.',
        'photo.mimes' => 'Le champ photo doit être au format PNG ou JPG.',
        'description.required' => 'Le champ description est requis.',
        'description.date' => 'Le champ description doit être une date valide.',
        'dateDebut.required' => 'Le champ date de début est requis.',
        'dateDebut.date' => 'Le champ date de début doit être une date valide.',
        'dateDebut.after_or_equal' => 'La date de début doit être égale ou postérieure à la date d\'aujourd\'hui.',
    ];
}
}
