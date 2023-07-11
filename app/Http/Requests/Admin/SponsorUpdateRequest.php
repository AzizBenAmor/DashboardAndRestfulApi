<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SponsorUpdateRequest extends FormRequest
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
            'nomU'=>'required',
            'linkU'=>'required|url',
        ];
    }
    public function messages(): array
{
    return [
        'photoU.file' => 'Le fichier doit être un fichier valide.',
        'photoU.mimes' => 'Le fichier doit être de type JPG ou PNG.',
        'nomU.required' => 'Le champ nom est requis.',
        'linkU.required' => 'Le champ lien est requis.',
        'linkU.url' => 'Le champ lien doit être une URL valide.',
    ];
}
}
