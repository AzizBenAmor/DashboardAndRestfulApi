<?php

namespace App\Http\Requests\Partenaire;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'=>'required|email|exists:partenaires,email',
            'password'=>'required|min:5|max:30'
        ];
    }
    public function messages(): array
{
    return [
        'email.required' => 'Le champ email est requis.',
        'email.email' => 'Le champ email doit être une adresse email valide.',
        'email.exists' => "L'email saisi n'existe pas.",
        'password.required' => 'Le champ mot de passe est requis.',
        'password.min' => 'Le mot de passe doit comporter au moins :5 caractères.',
        'password.max' => 'Le mot de passe ne peut pas dépasser :30 caractères.',
    ];
}
}
