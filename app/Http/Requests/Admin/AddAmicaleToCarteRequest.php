<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddAmicaleToCarteRequest extends FormRequest
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
            'amicale'=>'required',
        'minid' => 'required|numeric|min:1',
        'maxid' => 'required|numeric|gt:minid',
        ];
    }
    public function messages(): array
{
    return [
        'amicale.required' => 'Le champ amicale est requis.',
        'minid.required' => 'ce champ est requis.',
        'minid.numeric' => 'ce champ doit être une carte.',
        'maxid.required' => 'ce champ est requis.',
        'maxid.numeric' => 'ce champ doit être une carte.',
        'maxid.gt' => 'Le champ maxid doit être supérieur à Carte Debut.',
    ];
}
}
