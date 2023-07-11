<?php

namespace App\Imports;

use App\Models\Carte;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CartesImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Carte([
            'codeBar'  => $row['codebar'],
            'cause_id'=>3,
        ]);
    }
    public function rules(): array
    {
        return [
        'codebar' =>'required|unique:cartes,codeBar|numeric|digits:16',
        ];
    }
    public function messages(): array
{
return [
'codebar.required' => 'Le champ codebar est requis.',
'codebar.unique' => 'Ce codebar est déjà utilisé.',
'codeBar.numeric' => 'Le champ code a Barre doit être un nombre.',
'codebar.digits' => 'Le champ code a barre doit contenir 16 chiffres.',
];
}
}
