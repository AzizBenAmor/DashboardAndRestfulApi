<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use  App\Http\Requests\Admin\OfferRequest;
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


class OfferController extends Controller
{
    function SearchOffer(Request $request)
    {
       $offers = Offer::where('nom','LIKE','%'.$request->offer_nom.'%')->paginate(5);
       $partenaires=Partenaire::all();
       return view('dashboard.admin.offer.search',compact('offers','partenaires')) ;
    }
   function Index($idpartenaire){
    $offers=Offer::latest()->where('partenaire_id',$idpartenaire)->paginate(5);
    $partenaire=Partenaire::findorfail($idpartenaire);
    return view('dashboard.admin.partenaire.offer.index',compact('offers','partenaire'));
   }
   function OfferStore(OfferRequest $request,$idpartenaire){
   
    $partenaire=Partenaire::findorfail($idpartenaire);
      $profession=Profession::findorfail($partenaire->profession_id);
            $newname = uniqid();
            $image = $request->file('photo');
            $newnamee= $newname;
            $newnamee .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newnamee);
        
         
            $offer= new offer();
        
        $offer->nom=$request->nom;
        $offer->description=$request->description;
        $offer->adress=$request->adress;
        $offer->image=$newnamee;
        $offer->partenaire_id=$partenaire->id;
        $offer->reduction=$request->reduction;
        $offer->prix=$request->prix;
        $offer->dateDebut=$request->dateDebut;
        $offer->dateFin=$request->dateFin;
        $offer->tel=$request->tel;
      
        $offer->stat=1;
       
    if ($partenaire->nom == 'Yooreed') {
        $offer->type=2;
        $offer->permanent=0;
    } 
    elseif  ($profession->nom=='Médecin' || $profession->nom== 'Avocat' ) {
        $offer->type=1;
        $offer->permanent=1;
    } 
    else {
        $offer->type=0;
        $offer->permanent=1;
    }
        $offer->save();
        return redirect()->back()->with('success',"Offer a été ajouter avec succès");       
}

function OfferYooreedStore(OfferRequest $request){
  
   
      $partenaire=Partenaire::where('nom','Yooreed')->first();
        
            $newname = uniqid();
            $image = $request->file('photo');
            $newnamee= $newname;
            $newnamee .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newnamee);
        
         
            $offer= new offer();
        
        $offer->nom=$request->nom;
        $offer->description=$request->description;
        $offer->adress=$request->adress;
        $offer->image=$newnamee;
        $offer->partenaire_id=$partenaire->id;
        $offer->reduction=$request->reduction;
        $offer->prix=$request->prix;
        $offer->dateDebut=$request->dateDebut;
        $offer->dateFin=$request->dateFin;
        $offer->tel=$request->tel;
        $offer->permanent=0;
        $offer->stat=1;
        $offer->type=2;
        $offer->save();
        return redirect()->back()->with('success',"Offer a été ajouter avec succès");       
}


function DeleteOffer($idoffer){
    $offer=Offer::findorfail($idoffer);
    $offer->delete();
    return redirect()->back()->with('success','Offer a été supprimer avec succès');
}
function AcceptOffer($idoffer){
    $offer=Offer::findorfail($idoffer);
    $offer->stat=1;
    $offer->update();
    return redirect()->back()->with('success','Offer a été accepter avec succès');
}
function RefuseOffer($idoffer){
    $offer=Offer::findorfail($idoffer);
    $offer->stat=2;
    $offer->update();
    return redirect()->back()->with('success','Offer a été refuser avec succès');
}
function PendingOffer(){
    $offers=Offer::oldest()->where('stat',0)->paginate(5);
    $partenaires=Partenaire::all();
    return view('dashboard.admin.offer.pending',compact('offers','partenaires'));
}
function AcceptedOffer(){
    $offers=Offer::oldest()->where('stat',1)->paginate(5);
    $partenaires=Partenaire::all();

    return view('dashboard.admin.offer.accepted',compact('offers','partenaires'));
}
function RefusedOffer(){
    $offers=Offer::oldest()->where('stat',2)->paginate(5);
    $partenaires=Partenaire::all();
  
    return view('dashboard.admin.offer.refused',compact('offers','partenaires'));
}
function YooreedOffer(){
    $offers=Offer::oldest()->where('type',2)->paginate(5);
    $partenaires=Partenaire::all();
  
    return view('dashboard.admin.offer.yooreed',compact('offers','partenaires'));
}

}
