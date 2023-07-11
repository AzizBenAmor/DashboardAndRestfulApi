<?php

namespace App\Imports;
use Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Adherent;
use App\Models\Carte;
use App\Models\Amicale;
use App\Models\Gouvernorat;
use App\Models\Ville;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class AdherentsImport implements ToModel,WithHeadingRow,WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $adherent = Adherent::where('email', $row['email'])->first();
        if ($adherent) {
            $adherent->update([
                'carte_id'  => $this->getCarte_id($row['codebar'],$row['amicale']) 
            ]);
        } else {
            $adherent=Adherent::create([
                'nom'  => $row['nom'],
                'email'  => $row['email'],
                'password' => Hash::make($this->getPassword($row['email'])),
                'tel'  => $row['tel'],
                'cin'  => $row['cin'],
                'gov_id'  => $this->gov_id($row['gouvernorat']),
                'ville_id'  => $this->ville_id($row['ville']),
                'adress'  => $row['adress'],
                'amicale_id'  => $this->getAmicale_id($row['amicale']),
                'carte_id'  => $this->getCarte_id($row['codebar']) 
            ]);
        }
        return $adherent;
      
    }

    private function getCarte_id($codeBar){
        $carte=Carte::where('codeBar',$codeBar)->first();
        
        $carte->date=Carbon::today();
        $carte->is_active=1;
        $carte->update();
        return $carte->id;
       
        
    }
    private function getAmicale_id($amicale){
        $amicale=Amicale::where('nom',$amicale)->first();
            return $amicale->id;
        
       
    }
    private function gov_id($gov){
        $gov=Gouvernorat::where('nom',$gov)->first();
        if(!$gov) return null;
        return $gov->id;
    }
    private function ville_id($ville){
        $ville=Ville::where('nom',$ville)->first();
        if(!$ville) return null;
        return $ville->id;
    }
    private function getPassword($email){
            $password=Str::random(8);
            $mail_data=[
                'recipient'=>$email,
                'fromEmail'=>'azizbenamor1288@gmail.com',
                'fromName'=>'Yooreed',
                'subject'=>'Your account as a Adherent',
                'body'=> $password
            ];
            Mail::send('emailTemplate/AdherentPassword', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'],'Yooreed')
                ->subject($mail_data['subject']);
            });
            return $password;
    }
    public function rules(): array
    {
        return [
            'nom' => 'required|regex:/^[\pL\s\'é]+$/u',
            'email'=>'required|email|unique:adherents,email',      
            'tel'=>'required|numeric|digits:8',
            'cin'=>'required|numeric|digits:8',
            'gouvernorat'=>'required|exists:gouvernorats,nom',
            'ville'=>'required|exists:villes,nom',
            'adress'=>'required',
            'amicale'=>'required|exists:amicales,nom',
            'codebar'=>'required|numeric|digits:16',
            
        ]
        
        ;
    }
    public function messages(): array
{
return [
'nom.required' => 'Le champ nom est requis.',
'nom.regex' => 'Le champ nom doit contenir uniquement des lettres et des espaces.',
'email.required' => 'Le champ email est requis.',
'email.email' => 'Le champ email doit être une adresse email valide.',
'email.unique' => 'Cet email est déjà utilisé.',
'tel.required' => 'Le champ téléphone est requis.',
'tel.numeric' => 'Le champ téléphone doit être un nombre.',
'tel.digits' => 'Le champ téléphone doit contenir 8 chiffres.',
'cin.required' => 'Le champ CIN est requis.',
'cin.numeric' => 'Le champ CIN doit être un nombre.',
'cin.digits' => 'Le champ CIN doit contenir 8 chiffres.',
'gouvernorat.required' => 'Le champ gouvernorat est requis.',
'gouvernorat.exists' => 'Le gouvernorat sélectionné est invalide.',
'ville.required' => 'Le champ ville est requis.',
'ville.exists' => 'La ville sélectionnée est invalide.',
'adress.required' => 'Le champ adresse est requis.',
'amicale.required' => 'Le champ amicale est requis.',
'amicale.exists' => "L'amicale sélectionnée est invalide.",
'codebar.required' => 'Le champ codebar est requis.',
'codebar.unique' => 'Ce codebar est déjà utilisé.',
'codebar.numeric' => 'Le champ code a barre doit être un nombre.',
'codebar.digits' => 'Le champ code a barre doit contenir 16 chiffres.',
];
}
}
