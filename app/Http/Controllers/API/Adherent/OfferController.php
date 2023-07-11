<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterRequest;
use App\Http\Requests\Api\NomRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Partenaire;
use App\Models\Profession;
use App\Models\Specialite;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetPermanentOffer()
    {
        $offer=Offer::where('stat',1)->where('permanent',1)->whereNot('type',2)->latest()->get();
        $offer->load('partenaires');
        return response()->json($offer);
    }
    public function GetNewsOffer()
    {
        $offer=Offer::where('stat',1)->where('permanent',0)->whereNot('type',2)->latest()->get();
        $offer->load('partenaires');
        return response()->json($offer);
    }
    public function GetYooreedOffer()
    {
        $offer=Offer::where('stat',1)->where('type',2)->latest()->get();
        return response()->json($offer);    
    }
    function GetPartenaire($id){
        $partenaire=Partenaire::findorfail($id);
        return response()->json($partenaire);
    }
    public function search(Request $request){
        $partenaire = Partenaire::query();
        $partenaire = Partenaire::where('nom','LIKE','%'.$request->nom.'%')->get();
        
        $offerResults = Offer::where('stat',1)->whereIn('partenaire_id', $partenaire->pluck('id'))->latest()->get(); ;

        return response()->json($offerResults);
    }
    public function searchPermanent(Request $request){
        $partenaire = Partenaire::query();
        $partenaire = Partenaire::where('nom','LIKE','%'.$request->nom.'%')->get();
        
        $offerResults = Offer::whereNot('type',2)->where('stat',1)->where('permanent',1)->whereIn('partenaire_id', $partenaire->pluck('id'))->latest()->get(); ;

        return response()->json($offerResults);
    }
    public function searchNews(Request $request){
        $partenaire = Partenaire::query();
        $partenaire = Partenaire::where('nom','LIKE','%'.$request->nom.'%')->get();
        
        $offerResults = Offer::whereNot('type',2)->where('stat',1)->where('permanent',0)->whereIn('partenaire_id', $partenaire->pluck('id'))->latest()->get(); ;

        return response()->json($offerResults);
    }
  
    function filterPermanent(FilterRequest $request){
   
    
        $partenaire = Partenaire::query();
    
        if ($request->gov) {
            $partenaire->where('gov_id', $request->gov);
        }
    
        if ($request->profession) {
            $partenaire->where('profession_id', $request->profession);
        }
    
        if ($request->secteur) {
            $partenaire->where('secteur_id', $request->secteur);
        }
    
        $partenaireResults = $partenaire->get();
        $offerResults = Offer::whereNot('type',2)->where('stat',1)->where('permanent',1)->whereIn('partenaire_id', $partenaireResults->pluck('id'))->latest()->get();
        $offerResults->load('partenaires');
        return response()->json($offerResults);
    
    }
    function filterNews(FilterRequest $request){
        $partenaire = Partenaire::query();
    
        if ($request->gov) {
            $partenaire->where('gov_id', $request->gov);
        }
    
        if ($request->profession) {
            $partenaire->where('profession_id', $request->profession);
        }
    
        if ($request->secteur) {
            $partenaire->where('secteur_id', $request->secteur);
        }
    
        $partenaireResults = $partenaire->get();
        $offerResults = Offer::whereNot('type',2)->where('stat',1)->where('permanent',0)->whereIn('partenaire_id', $partenaireResults->pluck('id'))->get();
        $offerResults->load('partenaires');
        return response()->json($offerResults);
    
    }
    public function SearchPartenaireSector($id, Request $request){
        $partenaire=Partenaire::where('secteur_id',$id)->where('nom','LIKE','%'.$request->nom.'%')->get();
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
    public function PartnerByOffer($id){
        
        $offer=Offer::findorfail($id);
        $partenaire=Partenaire::findorfail($offer->partenaire_id);
        return response()->json($partenaire);

    }

}
