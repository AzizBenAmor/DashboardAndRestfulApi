<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\Models\Adherent;
use App\Models\Amicale;
use App\Models\Carte;
use App\Models\Cause;
use App\Models\Gouvernorat;
use App\Models\Partenaire;
use App\Models\Profession;
use App\Models\Publicite;
use App\Models\Specialite;
use App\Models\Ville;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;

class AdherentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function AdherentData(){
        $adherent=Auth::user();
        $gov=Gouvernorat::findorfail($adherent->gov_id);
        $ville=Ville::findorfail($adherent->ville_id);
        $amicale=Amicale::findorfail($adherent->amicale_id);
        $array=[
            'adress'=>$adherent->adress,
            'tel'=>$adherent->tel,
            'nom'=>$adherent->nom,
            'gov'=>$gov->nom,
            'ville'=>$ville->nom,
            'amicale'=>$amicale->nom
        ];
        return response()->json($array);
    }
    public function ChangePassword(UpdatePasswordRequest $request){
        $adherent=Auth::user();
        $creds=[
            'email'=>$adherent->email,
            'password'=>$request->old_password
        ];
       if (!Auth::guard('adherent')->attempt($creds)) {
        return response()->json("l'ancien mot de passe est erroné");
       } 
    $adherent->password= Hash::make($request->password);
    $adherent->password_changed=true;
    $adherent->update();
    return response()->json('Le mot de passe a été changé avec succès ');
    }
    public function GetPublicite(){
        $pub=Publicite::where('post',1)->get();
        return response()->json($pub);
    }
    
    public function ConsultCard(){
        $adherent=Auth::user();
        $carte=Carte::findorfail($adherent->carte_id);
        $expiredDate = date('Y-m-d', strtotime($carte->date. ' + 1 years'));
        $cause=null;
        if ($carte->cause_id) {
            $causee=Cause::where('id',$carte->cause_id)->first();
            $cause=$causee->description;
        }
       
        $array=[
            'codeBar'=>$carte->codeBar,
            'is_active'=>$carte->is_active,
            'date'=>$carte->date,
            'expiredDate'=>$expiredDate,
            'cause'=>$cause
        ];
        

        return response()->json($array);
    }
    public function ConsultPartner($id){
        $partenaire=Partenaire::where('secteur_id',$id)->get();
        $array = [];
        foreach ($partenaire as $key => $p) {
            $profession=Profession::findorfail($p->profession_id);
            $specialite=Specialite::findorfail($p->specialite_id);
            $item = [
                'nom' => $p->nom,
                'adress' => $p->adress,
                'numero'=>$p->numero,
                'email' => $p->email,
                'image'=>$p->image,
                'profession'=>$profession->nom,
                'specialite'=>$specialite->nom
            ];
            $array[] = $item;
        }
        $uniqueArray = collect($array)->unique('nom')->values()->all();
        
    return response()->json($uniqueArray);
    }
   
}
