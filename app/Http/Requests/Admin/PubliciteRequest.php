<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PubliciteRequest extends FormRequest
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
            'owner'=>'required',
            'file'=>'required|file|mimes:mp4,ogx,oga,ogv,ogg,webm,png,jpg|max:20480',
            'dateDebut'=>'required|date|after_or_equal:today',
            'dateFin'=>'required|date|after:dateDebut'
        ];
    }
    public function messages(): array
{
    return [
        'owner.required' => 'Le champ propriétaire est requis.',
        'file.required' => 'Le champ fichier est requis.',
        'file.file' => 'Le fichier doit être un fichier valide.',
        'file.mimes' => 'Le fichier doit être de type :values.',
        'file.max' => 'La taille du fichier ne peut pas dépasser :max 20 MO.',
        'dateDebut.required' => 'Le champ date de début est requis.',
        'dateDebut.date' => 'Le champ date de début doit être une date valide.',
        'dateDebut.after_or_equal' => 'La date de début doit être égale ou postérieure à la date actuelle.',
        'dateFin.required' => 'Le champ date de fin est requis.',
        'dateFin.date' => 'Le champ date de fin doit être une date valide.',
        'dateFin.after' => 'La date de fin doit être postérieure à la date de début.',
    ];
}

}
