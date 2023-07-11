<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfessionRequest;
use App\Http\Requests\Admin\ProfessionUpdateRequest;
use App\Http\Requests\Admin\SecteurRequest;
use App\Http\Requests\Admin\SecteurUpdateRequest;
use App\Http\Requests\Admin\SpecialiteRequest;
use App\Http\Requests\Admin\SpecialiteUpdateRequest;
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

class SecteurProfessionSpecial extends Controller
{
    public function test1()
    {
        $data['secteurs'] = Secteur::get(["nom","id"]);
       
        return view('secteur-state-profession', $data);
    }
    public function test2()
    {
        $data['professions'] = profession::get(["nom","id"]);
       
        return view('profession-state-specialite', $data);
    }
    public function getProfession(Request $request)
    {
        $data['professions'] = Profession::where("secteur_id", $request->secteur_id)
                                ->get(["nom", "id"]);
      
        return response()->json($data);
    }
    
    public function getSpecialite(Request $request)
    {
        $data['specialites'] = Specialite::where("profession_id", $request->profession_id)
                                ->get(["nom", "id"]);
        return response()->json($data);
    }
    //---------------------------------------Secteur------------------------------------------------------------------------
    function SecteurIndex(){
        $secteurs=Secteur::latest()->paginate(5);
        $professions=Profession::all();
        return view('dashboard.admin.secteur.index',compact('secteurs','professions'));
    }
 
    function SecteurUpdate(SecteurUpdateRequest $request,$idsecteur){
        $secteur=Secteur::findorfail($idsecteur);
        $secteur->nom=$request->nomU;
        $secteur->update();
        return redirect()->back()->with('success','Secteur a été modifier avec succès');
    }

    function SecteurStore(SecteurRequest $request){
        $secteur= new Secteur;
        $secteur->nom=$request->nom;
        $secteur->save();
        return redirect()->back()->with('success','Secteur a été ajouter avec succès');
    }
    function SearchSecteur(Request $request)
    {
       $secteurs = Secteur::where('nom','LIKE','%'.$request->secteur.'%')->paginate(5);  
       $professions=Profession::all();
       return view('dashboard.admin.secteur.index',compact('secteurs','professions'));
    }
    //-----------------------------------------Profession--------------------------------------------------
    function ProfessionIndex($idsecteur){
        $professions=Profession::where('secteur_id',$idsecteur)->paginate(5);  
        $specialite=Specialite::all();
        return view('dashboard.admin.secteur.profession.index',compact('professions','idsecteur','specialite'));
    }
   
    function ProfessionUpdate(ProfessionUpdateRequest $request,$idprofession){
        $profession=Profession::findorfail($idprofession);
        $profession->nom=$request->nomU;
        $profession->update();
        return redirect()->route('admin.ProfessionIndex',$profession->secteur_id)->with('success','Profession a été modifier avec succès');
    }
    
    function ProfessionStore(ProfessionRequest $request,$idsecteur){
        $profession= new Profession;
        $profession->nom=$request->nom;
        $profession->secteur_id=$idsecteur;
        $profession->save();
        return redirect()->back()->with('success','Profession a été ajouter avec succès');
    }
    function SearchProfession(Request $request)
    {
       $professions = Profession::where('nom','LIKE','%'.$request->secteur.'%')->paginate(5);  
       $specialite=Specialite::all();
        return view('dashboard.admin.secteur.profession.search',compact('professions','specialite'));
    }
    //--------------------------------Specialite --------------------------------------------
    function SpecialiteIndex($idprofession){
        $specialites=Specialite::where('profession_id',$idprofession)->paginate(5);
        return view('dashboard.admin.secteur.profession.specialite.index',compact('specialites','idprofession'));
    }
   
    function SpecialiteUpdate(SpecialiteUpdateRequest $request,$idspecialite){
        $specialite=Specialite::findorfail($idspecialite);
        $specialite->nom=$request->nomU;
        $specialite->update();
        return redirect()->back()->with('success','Specialite a été modifier avec succès');
    }
  
    function SpecialiteStore(SpecialiteRequest $request,$idprofession){
        $specialite= new Specialite;
        $specialite->nom=$request->nom;
        $specialite->profession_id=$idprofession;
        $specialite->save();
        return redirect()->back()->with('success','Specialite a été ajouter avec succès');
    }
    function SearchSpecialite(Request $request)
    {
       $specialites = Specialite::where('nom','LIKE','%'.$request->secteur.'%')->paginate(5);  
       return view('dashboard.admin.secteur.profession.specialite.search',compact('specialites'));
    }
}
