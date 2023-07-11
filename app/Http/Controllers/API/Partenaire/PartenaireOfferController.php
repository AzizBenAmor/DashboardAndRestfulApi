<?php

namespace App\Http\Controllers\API\Partenaire;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OfferRequest;
use App\Http\Requests\Api\NomRequest;
use App\Http\Requests\Api\OfferUpdateRequest;
use App\Models\Offer;
use App\Models\Partenaire;
use App\Models\Profession;
use App\Models\Secteur;
use App\Models\Specialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartenaireOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetAllOffer()
    {
        $user=Auth::user()->id;
        $offers=Offer::where('partenaire_id',$user)->get();
        return response()->json($offers);
    }
    public function GetOffer($id)
    {
        $offer=Offer::findorfail($id);
        return response()->json($offer);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(OfferRequest $request)
    {

        $partenaire=Auth::user();
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
            $offer->permanent=0;
            $offer->stat=0;

            if ($partenaire->nom == 'Yooreed') {
                $offer->type=2;
            }
            elseif  ($profession->nom=='Médecin' || $profession->nom== 'Avocat' ) {
                $offer->type=1;
            }
            else {
                $offer->type=0;
            }
            $offer->save();
            return response()->json( 'offre ajouter avec succès');

    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OfferUpdateRequest $request, string $id)
    {
        $offer=Offer::findorfail($id);


        if ($offer->stat!=0) {
          return response()->json("offre ne peut pas ètre modifié");
        }
        else {
        $partenaire=Auth::user();

        if ($request->photo) {
                $newname = uniqid();
                $image = $request->file('photo');
                $newnamee= $newname;
                $newnamee .= "." . $image->getClientOriginalExtension();
                $destinationPath = 'uploads';
                $image->move($destinationPath, $newnamee);

          $file_path=public_path().'/uploads/'.$partenaire->image;
          if (file_exists($file_path)) {
           unlink($file_path);
          }
        }
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
            $offer->update();
            return response()->json( 'offre modifier avec succès');     }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partenaire=Auth::user()->id;
        $offer=Offer::where('id',$id)->where('partenaire_id',$partenaire)->first();
        $offer->delete();
        return response()->json('offre supprimée avec succès');
    }
    public function searchPending(Request $request){
        $partenaire=Auth::user();
        $offerResults = Offer::where('partenaire_id',$partenaire->id)->where('stat',0)->where('nom','LIKE','%'.$request->nom.'%')->latest()->get(); ;

        return response()->json($offerResults);
    }
    public function searchAccepted(Request $request){
        $partenaire=Auth::user();
        $offerResults = Offer::where('partenaire_id',$partenaire->id)->where('stat',1)->where('nom','LIKE','%'.$request->nom.'%')->latest()->get(); ;

        return response()->json($offerResults);
    }
    public function searchRefused(Request $request){
        $partenaire=Auth::user();
        $offerResults = Offer::where('partenaire_id',$partenaire->id)->where('stat',2)->where('nom','LIKE','%'.$request->nom.'%')->latest()->get(); ;

        return response()->json($offerResults);
    }
    public function getbysecteur($id)
    {
        $secteur=Secteur::find($id);
        // if($secteur){
        //     $partenaires=Partenaire::where('secteur_id','=',$secteur->id)->with('secteurs:id,nom')
        //                            ->with('professions:id,nom')
        //                            ->with('specialites:id,nom')
        //                            ->get();
        //     if(count($partenaires)>0){
        //         return response([
        //             'partenaires'=>$partenaires
        //         ],200);
        //     }else{
        //         return response([
        //     'partenaires'=>[]
        //         ]);
        //     }
        // }
        $partenaire=Partenaire::where('secteur_id',$id)->get();
        $array=[];
        foreach ($partenaire as $key => $p) {

            $secteur=Secteur::findorfail($p->secteur_id);
            $profession=Profession::findorfail($p->profession_id);
            $specilaitie=Specialite::findorfail($p->specialite_id);
            $array=[
                'partenaires'=>$p,
                'secteurs'=>$secteur,
                'professions'=>$profession,
                'specialites'=>$specilaitie
            ];
        }
        return response()->json($array);
    }
}
