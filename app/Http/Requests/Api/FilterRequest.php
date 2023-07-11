<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'gov' => 'nullable|exists:gouvernorats,id',
            'profession' => 'nullable|exists:professions,id',
            'secteur' => 'nullable|exists:secteurs,id',
        ];
    }
    public function messages(): array
{
    return [
        'gov.exists' => 'La gouvernorat sélectionné n\'existe pas dans la base de données.',
        'profession.exists' => 'La profession sélectionnée n\'existe pas dans la base de données.',
        'secteur.exists' => 'Le secteur sélectionné n\'existe pas dans la base de données.',
    ];
}

}
