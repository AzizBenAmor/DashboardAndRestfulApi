<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'titre'=>'required|regex:/^[\pL\s\'é]+$/u',
            'description'=>'required',
        ];
    }
    public function messages(): array
{
    return [
        'photo.required' => 'Le champ photo est requis.',
        'photo.file' => 'Le fichier doit être un fichier valide.',
        'photo.mimes' => 'Le fichier doit être de type JPG ou PNG.',
        'titre.required' => 'Le champ titre est requis.',
        'titre.regex' => 'Le champ titre ne doit contenir que des lettres.',
        'description.required' => 'Le champ description est requis.',
    ];
}
}
