<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
            'photoU'=>'nullable|file|mimes:jpg,png',
            'titreU'=>'required|regex:/^[\pL\s\'é]+$/u',
            'descriptionU'=>'required',
        ];
    }
    public function messages(): array
{
    return [
        'photoU.file' => 'Le fichier doit être un fichier valide.',
        'photoU.mimes' => 'Le fichier doit être de type JPG ou PNG.',
        'titreU.required' => 'Le champ titre est requis.',
        'titreU.regex' => 'Le champ titre ne doit contenir que des lettres.',
        'descriptionU.required' => 'Le champ description est requis.',
    ];
}

}
