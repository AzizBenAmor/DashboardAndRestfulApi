<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GouvernoratRequest;
use App\Http\Requests\Admin\GouvernoratUpdateRequest;
use App\Http\Requests\Admin\VilleRequest;
use App\Http\Requests\Admin\VilleUpdateRequest;
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
use App\Models\Gouvernorat;
use App\Models\Offer;

class GouvVilleAdminController extends Controller
{
    // Gov et ville select method--------------------------------------------------------------------------
public function test() {
        $data['gouvernorats'] = Gouvernorat::get(["nom","id"]);
        return view('country-state-city',$data);
    }

public function getVilles(Request $request)
    {
        $data['villes'] = Ville::where("gov_id", $request->gov_id)
                                ->get(["nom", "id"]);
  
        return response()->json($data);
    }
    //-------------------------------------Gouvernorat------------------------------------------------------
    function SearchGouvernorat(Request $request)
    {
       $gov = Gouvernorat::where('nom','LIKE','%'.$request->gouv_nom.'%')->paginate(5);  
       $villes=Ville::all();
       return view('dashboard.admin.gouvernorat.index',compact('gov','villes'));
    }
    function GouvernoratIndex(){
    $gov=Gouvernorat::latest()->paginate(5);
    $villes=Ville::all();
    return view('dashboard.admin.gouvernorat.index',compact('gov','villes'));
}

function UpdateGouvernorat(GouvernoratUpdateRequest $request,$idgov){
   
    $gov= Gouvernorat::findorfail($idgov);
    $gov->update([
        'nom' => $request->nomU,
    ]);
    return redirect()->back()->with('success',"la gouvernorat a été modifier avec succès");
}
function GouvernoratStore(GouvernoratRequest $request){
  
    $gov = new Gouvernorat();
    $gov->nom=$request->nom;
    $gov->save();
    return redirect()->back()->with('success',"la gouvernorat a été ajouter avec succès");
}

function GouvernoratDelete($idgov){
    $adherent=Adherent::all();
    $amicale=Amicale::all();
    $partenaire=Partenaire::all();
    $gov=Gouvernorat::findorfail($idgov);
    foreach ($adherent as $key => $a) {
      if ($a->gov_id==$gov->id) {
        return redirect()->back()->with('error',"Gouvernorat ne peux pas etre supprimer");
      } 
    }
    foreach ($amicale as $key => $a) {
        if ($a->gov_id==$gov->id) {
          return redirect()->back()->with('error',"Gouvernorat ne peux pas etre supprimer");
        } 
      }
      foreach ($partenaire as $key => $a) {
        if ($a->gov_id==$gov->id) {
          return redirect()->back()->with('error',"Gouvernorat ne peux pas etre supprimer");
        } 
      }
    $gov=Gouvernorat::findorfail($idgov);
    $gov->delete();
    return redirect()->back()->with('success',"la gouvernorat a été supprimer avec succès");
}
//-------------------------------------Ville-------------------------------------------------------
function SearchVille(Request $request)
{
   $villes = Ville::where('nom','LIKE','%'.$request->ville_nom.'%')->paginate(5);
    $gov=Gouvernorat::all();
   return view('dashboard.admin.gouvernorat.ville.search',compact('villes','gov')) ;
}
function VilleIndex($id){
    $gov=Gouvernorat::findorfail($id);
    
    $villes=Ville::where('gov_id',$id)->paginate(5);
    return view('dashboard.admin.gouvernorat.ville.index',compact('gov','villes'));
}

function Updateville(VilleUpdateRequest $request,$idville){
  
    $ville= ville::findorfail($idville);
    $ville->update([
        'nom' => $request->nomU,
    ]);
    return redirect()->route('admin.VilleIndex',$ville->gov_id)->with('success',"la ville a été modifier avec succès");
}
function VilleStore(VilleRequest $request,$govid){
  
    $ville = new Ville();
    $ville->nom=$request->nom;
    $ville->gov_id=$govid;
    $ville->save();
    return redirect()->back()->with('success',"la ville a été ajouter avec succès");
}

function VilleDelete($idville){
    $adherent=Adherent::all();
    $amicale=Amicale::all();
    $partenaire=Partenaire::all();
    $ville=Ville::findorfail($idville);
    foreach ($adherent as $key => $a) {
      if ($a->ville_id==$ville->id) {
        return redirect()->back()->with('error',"Ville ne peux pas etre supprimer");
      } 
    }
    foreach ($amicale as $key => $a) {
        if ($a->ville_id==$ville->id) {
          return redirect()->back()->with('error',"Ville ne peux pas etre supprimer");
        } 
      }
      foreach ($partenaire as $key => $a) {
        if ($a->ville_id==$ville->id) {
          return redirect()->back()->with('error',"Ville ne peux pas etre supprimer");
        } 
      }
  
    $ville->delete();
    return redirect()->back()->with('success',"la ville a été supprimer avec succès");
}
}
