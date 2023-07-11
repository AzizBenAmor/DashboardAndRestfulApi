<?php

namespace App\Http\Controllers\API\Partenaire;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ScannerRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Amicale;
use App\Models\Partenaire;
use App\Models\Secteur;
use App\Models\Profession;
use App\Models\Specialite;
use App\Models\Promo;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Evenement;
use App\Models\Admin;
use App\Models\Adherent;
use App\Models\Carte;
use App\Models\Ville;
use App\Models\Cause;
use App\Models\Offer;
use Illuminate\Support\Facades\DB;
use App\Models\Gouvernorat;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Hash;

class PartenaireController extends Controller
{
    public function PartenaireData(){
        $partenaire=Auth::user();
        $gov=Gouvernorat::findorfail($partenaire->gov_id);
        $ville=Ville::findorfail($partenaire->ville_id);
        $array=[
            'adress'=>$partenaire->adress,
            'tel'=>$partenaire->numero,
            'nom'=>$partenaire->nom,
            'gov'=>$gov->nom,
            'ville'=>$ville->nom,
             ];
        return response()->json($array);
    }
public function ChangePassword(UpdatePasswordRequest $request){
    $partenaire=Auth::user();
    $creds=[
        'email'=>$partenaire->email,
        'password'=>$request->old_password
    ];
   if (!Auth::guard('partenaire')->attempt($creds)) {
    return response()->json("l'ancien mot de passe est erroné");
   }
$partenaire->password= Hash::make($request->password);
$partenaire->changed_password= true;
$partenaire->update();
return response()->json('Le mot de passe a été changé avec succès');
}
public function Scanner(ScannerRequest $request, Transaction $transaction){

    $carte=Carte::where('codeBar',$request->codeBar)->first();
    if ($carte->is_active==0) {
        return response()->json("Carte non valide");
    }
    elseif ($carte->is_active==1) {
        $partenaire =auth()->user();
        $partenaire_id=$partenaire->id;
        $adherent=Adherent::where('carte_id',$carte->id)->first();
        $adherent_id=$adherent->id;
        $transaction->partenaire_id=$partenaire_id;
        $transaction->adherent_id=$adherent_id;
        $transaction->save();
        return response()->json("Carte est valide");
    }
}
public function Transaction(){
    $user = Auth::user()->id;
    $transactions = Transaction::where('partenaire_id', $user)->get();
    $array = [];

    foreach ($transactions as $transaction) {
        $number = DB::table('transactions')->where('adherent_id', $transaction->adherent_id)->count();
        $adherent = Adherent::findOrFail($transaction->adherent_id);

        $item = [
            'nom' => $adherent->nom,
            'tel' => $adherent->tel,
            'number' => $number
        ];

        $array[] = $item;
    }
    $uniqueArray = collect($array)->unique('nom')->values()->all();

    return response()->json($uniqueArray);
}
}
