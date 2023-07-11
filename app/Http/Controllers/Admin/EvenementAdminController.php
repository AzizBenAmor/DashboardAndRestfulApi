<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EvenementStoreRequest;
use App\Http\Requests\Admin\EvenementUpdateRequest;
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
use App\Models\Ville;
use App\Models\Cause;
use App\Models\Offer;

use App\Models\Gouvernorat;

class EvenementAdminController extends Controller
{
   //evenement Method-------------------------------------------------------------------------
   
   function SearchEvenement(Request $request)
   {
      $evenements = Evenement::where('titre','LIKE','%'.$request->evenement_nom.'%')->paginate(5);
    
      return view('dashboard.admin.evenement.index',compact('evenements'));
   }
 
    function EvenementDelete($idevenement){
       $evenement = Evenement::find($idevenement);
       $evenement->delete();
       return redirect()->back()->with('success',"l'evenement a été supprimer avec succès");
   }

   function EvenementUpdate($idevenement,EvenementUpdateRequest $request){
    $evenement=Evenement::findorfail($idevenement);
    $evenement->titre=$request->titreU;
    $evenement->dateDebut=$request->dateDebutU;
    $evenement->dateFin=$request->dateFinU;
    $evenement->description=$request->descriptionU;
  
  if ($request->photoU) {
   
 
       $file_path=public_path().'/uploads/'.$evenement->image;
       if (file_exists($file_path)) {
        unlink($file_path);
       }
      
       $newname = uniqid();
       $image = $request->file('photoU');
       $newnamee= $newname;
       $newnamee .= "." . $image->getClientOriginalExtension();
       $destinationPath = 'uploads';
       $image->move($destinationPath, $newnamee);
       $evenement->image=$newnamee; }
       $evenement->update();
    return redirect()->route('admin.EvenementIndex')->with('success',"l'evenement a été modifier avec succès");
}
   function EvenementIndex(){
       $evenements=Evenement::latest()->paginate(5);
       
       return view('dashboard.admin.evenement.index',compact('evenements'))->with(request()->input('page'));
   }
   function EvenementStore(EvenementStoreRequest $request){
 
    
           $newname = uniqid();
           $image = $request->file('photo');
           $newnamee= $newname;
           $newnamee .= "." . $image->getClientOriginalExtension();
           $destinationPath = 'uploads';
           $image->move($destinationPath, $newnamee);
          

       $evenement= new Evenement();
       $evenement->titre=$request->titre;
       $evenement->description=$request->description;
       $evenement->dateDebut=$request->dateDebut;
       $evenement->dateFin=$request->dateFin;
       $evenement->image=$newnamee;
       $evenement->save();
       return redirect()->back()->with('success',"l'evenement a été ajouter avec succès");
       }

       function EvenementPost($idevenement){
           $evenement=Evenement::findorfail($idevenement);
           $evenement->post = true;
           $evenement->update();
           return redirect()->back()->with('success',"l'evenement a été poster avec succès");}
       function EvenementUnPost($idevenement){
           $evenement=Evenement::findorfail($idevenement);
           $evenement->post = false;
           $evenement->update();
           return redirect()->back()->with('success',"l'evenement a été archiver avec succès");
       }
}
