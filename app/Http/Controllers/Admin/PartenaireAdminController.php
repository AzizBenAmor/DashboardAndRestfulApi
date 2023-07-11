<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartenaireStoreRequest;
use App\Http\Requests\Admin\PartenaireUpdateRequest;
use Illuminate\Http\Request;
use Auth;
use Str;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
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
use Illuminate\Support\Facades\Mail;
use App\Models\Gouvernorat;
use App\Models\Offer;

class PartenaireAdminController extends Controller
{
   //---------------------------Partenaire Method ----------------------------------------------------
function SearchPartenaire(Request $request)
{
   $partenaires = Partenaire::where('nom','LIKE','%'.$request->partenaire_nom.'%')->paginate(5);
   $secteurs=Secteur::all();
    $professions=Profession::all();
    $specialites=Specialite::all();
    $gouvernorats=Gouvernorat::all();
    $villes=Ville::all();
 
   return view('dashboard.admin.partenaire.index',compact('partenaires','secteurs','professions','specialites','gouvernorats','villes'));
}

function PartenaireDelete($idpartenaire){
    $partenaire = Partenaire::find($idpartenaire);
    $partenaire->delete();
    return redirect()->back()->with('success','Partenaire a été supprimer avec succès');
}
function PartenaireUpdate($idpartenaire,PartenaireUpdateRequest $request){
    $partenaire=Partenaire::findorfail($idpartenaire);
    if ($request->cinU!=$partenaire->cin) {
        $request->validate([
            'cinU'=>'required|numeric|digits:8|unique:partenaires,cin,',
        ],[
            'cinU.required' => 'Le champ CIN est requis.',
            'cinU.numeric' => 'Le champ CIN doit être un nombre.',
            'cinU.digits' => 'Le champ CIN doit contenir :8 chiffres.',
            'cinU.unique' => 'Ce numéro de CIN est déjà utilisé par un autre partenaire.',
        ]);
    }

    $partenaire->nom=$request->nomU;
    $partenaire->nom_responsable=$request->nom_responsableU;
    $partenaire->numero=$request->numeroU;
    $partenaire->adress=$request->adressU;
   $partenaire->cin=$request->cinU;
    if ($request->photoU) {
        $file_path=public_path().'/uploads/'.$partenaire->image;
       if (file_exists($file_path)) {
        unlink($file_path);
       }
       $newname = uniqid();
       $image = $request->file('photoU');
       $newnamee= $newname;
       $newnamee .= "." . $image->getClientOriginalExtension();
       $destinationPath = 'uploads';
       $image->move($destinationPath, $newnamee);
       $partenaire->image=$newnamee;
    }
         $partenaire->update();
    return redirect()->route('admin.PartenaireIndex')->with('success','Partenaire a été modifier avec succès');

}


function PartenaireIndex(){
    $partenaires=Partenaire::latest()->paginate(5);
    $secteurs=Secteur::all();
    $professions=Profession::all();
    $specialites=Specialite::all();
    $gouvernorats=Gouvernorat::all();
    $villes=Ville::all(); 
return view('dashboard.admin.partenaire.index',compact('partenaires','secteurs','professions','specialites','gouvernorats','villes'));
}
function PartenaireStore(PartenaireStoreRequest $request){

    $password=Str::random(8);
    $mail_data=[
        'recipient'=>$request->email,
        'fromEmail'=>'azizbenamor1288@gmail.com',//a changer Yooreed@contact.com
        'fromName'=>'Yooreed',
        'subject'=>"Votre compte en tant que partenaire",
        'body'=> $password
    ];
    Mail::send('emailTemplate/PartenairePassword', $mail_data, function ($message) use ($mail_data) {
        $message->to($mail_data['recipient'])
        ->from($mail_data['fromEmail'],'Yooreed')
        ->subject($mail_data['subject']);
    });
    
    $newname = uniqid();
    $image = $request->file('photo');
    $newnamee= $newname;
    $newnamee .= "." . $image->getClientOriginalExtension();
    $destinationPath = 'uploads';
    $image->move($destinationPath, $newnamee);
        $partenaire= new partenaire();
   
    $partenaire->nom=$request->nom;
    $partenaire->adress=$request->adress;
    $partenaire->password=Hash::make($password);
    $partenaire->nom_responsable=$request->nom_responsable;
    $partenaire->email=$request->email;
    $partenaire->numero=$request->numero;
    $partenaire->image=$newnamee;
    $partenaire->cin=$request->cin;
    $partenaire->gov_id=$request->gov_id;
    $partenaire->ville_id=$request->ville_id;
    $partenaire->secteur_id=$request->secteur_id;
    $partenaire->profession_id=$request->profession_id;
    $partenaire->specialite_id=$request->specialite_id;
    $partenaire->save();
    return redirect()->back()->with('success','Partenaire a été ajouter avec succès');
    }

}
