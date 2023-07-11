<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class GetProfessionRequest extends FormRequest
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
            'id'=>'required|exists:professions,id'
        ];
    }
    public function messages(): array
{
    return [
        'id.required' => 'Le champ profession est requis.',
        'id.exists' => 'Profession spécifié n\'existe pas dans la base de données.',
    ];
}
}
