<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'old_password'=>'required|min:5|max:30',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|same:password',
        ];
    }
    public function messages(): array
{
    return [
        'old_password.required' => 'Le champ mot de passe est requis.',
        'old_password.min' => 'Le mot de passe doit comporter au moins :5 caractères.',
        'old_password.max' => 'Le mot de passe ne peut pas dépasser :30 caractères.',
        'password.required' => 'Le champ mot de passe est requis.',
        'password.min' => 'Le mot de passe doit comporter au moins :5 caractères.',
        'password.max' => 'Le mot de passe ne peut pas dépasser :30 caractères.',
        'cpassword.required' => 'Le champ de confirmation du mot de passe est requis.',
        'cpassword.same' => 'Le champ de confirmation du mot de passe doit correspondre au champ mot de passe.',
    ];
}
}
