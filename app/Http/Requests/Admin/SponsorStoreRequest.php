<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SponsorStoreRequest extends FormRequest
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
            'nom'=>'required',
            'link'=>'required|url',
        ];
    }
    public function messages(): array
{
    return [
        'photo.required' => 'Le champ photo est requis.',
        'photo.file' => 'Le fichier doit être un fichier valide.',
        'photo.mimes' => 'Le fichier doit être de type JPG ou PNG.',
        'nom.required' => 'Le champ nom est requis.',
        'link.required' => 'Le champ lien est requis.',
        'link.url' => 'Le champ lien doit être une URL valide.',
    ];
}
}
