<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CarteStoreRequest extends FormRequest
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
            'codeBar'=>'required|unique:cartes,codeBar|numeric|digits:16',
            'amicale_id'=>'exists:amicales,id|nullable'
        ];
    }
    public function messages(): array
{
    return [
        'codeBar.required' => 'Le champ code a Barre est requis.',
        'codeBar.unique' => 'Ce code a Barre est déjà utilisé par une autre carte.',
        'codeBar.numeric' => 'Le champ code a Barre doit être un nombre.',
        'codeBar.digits' => 'Le champ code a Barre doit contenir :16 chiffres.',
        'amicale_id.exists' => 'L\'amicale sélectionnée n\'existe pas.',
    ];
}

}
