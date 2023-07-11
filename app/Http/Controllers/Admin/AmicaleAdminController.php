<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAmicaleRequest;
use App\Http\Requests\Admin\UpdateAmicaleRequest;
use Illuminate\Http\Request;
use Auth;
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
use App\Models\Offer;
use App\Models\Ville;
use App\Models\Cause;

use App\Models\Gouvernorat;

class AmicaleAdminController extends Controller
{
   
  

function UpdateAmicale(UpdateAmicaleRequest $request,$idamicale){
    $amicale= Amicale::findorfail($idamicale);
    if ($request->cinU!=$amicale->cin) {
        $request->validate([
            'cinU'=>'required|numeric|digits:8|unique:amicales,cin,',
        ],[
            'cinU.required' => 'Le champ CIN est requis.',
            'cinU.numeric' => 'Le champ CIN doit être un nombre.',
            'cinU.digits' => 'Le champ CIN doit contenir :8 chiffres.',
            'cinU.unique' => 'Ce numéro de CIN est déjà utilisé par un autre amicale.',
        ]);
    }
    $amicale->nom=$request->nomU;
    $amicale->nom_responsable=$request->nom_responsableU;
    $amicale->numero=$request->numeroU;
    $amicale->cin=$request->cinU;
  
   
    if ($request->photoU) {
        $file_path=public_path().'/uploads/'.$amicale->image;
       if (file_exists($file_path)) {
        unlink($file_path);
       }
       $newname = uniqid();
       $image = $request->file('photoU');
       $newnamee= $newname;
       $newnamee .= "." . $image->getClientOriginalExtension();
       $destinationPath = 'uploads';
       $image->move($destinationPath, $newnamee);
       $amicale->image=$newnamee;
    }
         $amicale->update();
    return redirect()->route('admin.Amicale')->with('success',"l'amicale a été modifier avec succès");
}
function SearchAmicale(Request $request)
{
   $amicales = Amicale::where('nom','LIKE','%'.$request->amicale_nom.'%')->paginate(5);
   $gouvernorats= Gouvernorat::all();
$villes= Ville::all();

   return view('dashboard.admin.amicale.index',compact('amicales','villes','gouvernorats'));
}
function AmicaleStore(StoreAmicaleRequest $request){


 
        $newname = uniqid();
        $image = $request->file('photo');
        $newnamee= $newname;
        $newnamee .= "." . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $newnamee);
        $amicale= new Amicale();
    
    $amicale->nom=$request->nom;
    $amicale->nom_responsable=$request->nom_responsable;
    $amicale->email=$request->email;
    $amicale->numero=$request->numero;
    $amicale->image=$newnamee;
    $amicale->cin=$request->cin;
    $amicale->gov_id=$request->gov_id;
    $amicale->ville_id=$request->ville_id;
    $amicale->save();
    return redirect()->back()->with('success',"l'amicale a été ajouter avec succès");
    }

    function AmicaleIndex(){
        $amicales = Amicale::latest()->paginate(5);
        $gouvernorats= Gouvernorat::all();
        $villes= Ville::all();
   
        return view('dashboard.admin.amicale.index',compact('amicales','villes','gouvernorats'));
    }
    function AmicaleDestroy($idamicale){
        $adherents= Adherent::all()->where('amicale_id',$idamicale);
        foreach ($adherents as $key => $adherent) {
            $a= $adherent;
            $a->delete();
        }
        $amicale = Amicale::find($idamicale);
        
        $amicale->delete();
        return redirect()->back()->with('success',"l'amicale a été supprimée avec succès");
        }
    
}