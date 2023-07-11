<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ScannerRequest extends FormRequest
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
            'codeBar'=>'required|exists:cartes,codeBar'
        ];
    }
    public function messages(): array
{
    return [
        'codeBar.required' => 'Le champ code a Barre est requis.',
        'codeBar.exists' => 'Le code a Barre spécifié n\'existe pas dans la base de données.',
    ];
}
}
