<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PromoRequest;
use App\Http\Requests\Admin\PromoUpdateRequest;
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
class PromoAdminController extends Controller
{
    //promo Method-------------------------------------------------------------------------
      
    function SearchPromo(Request $request)
    {
       $promos = Promo::where('titre','LIKE','%'.$request->promo_nom.'%')->paginate(5);  
       return view('dashboard.admin.promo.index',compact('promos'));
    }
 
    function PromoUpdate($idpromo,PromoUpdateRequest $request){
 
        $promo=Promo::findorfail($idpromo);
        $promo->titre=$request->titreU;
        $promo->dateDebut=$request->dateDebutU;
        $promo->dateFin=$request->dateFinU;
        $promo->description=$request->descriptionU;
        $promo->update();
        return redirect()->route('admin.PromoIndex')->with('success','Promo a été modifier avec succès');
    }

    function PromoDelete($idpromo){
        $promo = Promo::find($idpromo);
        $promo->delete();
        return redirect()->back();
    }
    function PromoPost($idpromo){
        $promo=Promo::findorfail($idpromo);
        $promo->post = true;
        $promo->update();
        return redirect()->back()->with('success','Promo a été poster avec succès');
    }
    function PromoUnPost($idpromo){
        $promo=Promo::findorfail($idpromo);
        $promo->post = false;
        $promo->update();
        return redirect()->back()->with('success','Promo a été archiver avec succès');
    }
    function PromoStore(PromoRequest $request){
       
        $promo= new Promo();
        $promo->titre=$request->titre;
        $promo->description=$request->description;
        $promo->dateDebut=$request->dateDebut;
        $promo->dateFin=$request->dateFin;
        $promo->save();
        return redirect()->back()->with('success','Promo a été ajouter avec succès');
    }
    function PromoIndex(){
        $promos=Promo::latest()->paginate(5);
        return(view('dashboard.admin.promo.index',compact('promos')));
    }
}
