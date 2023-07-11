<?php

namespace App\Http\Controllers\API\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FilterGovRequest;
use App\Http\Requests\Api\GetProfessionRequest;
use App\Http\Requests\Api\GetSpecialiteRequest;
use Illuminate\Http\Request;
use App\Models\Partenaire;
use App\Models\Gouvernorat;
use App\Models\Secteur;
use App\Models\Profession;
use App\Models\Specialite;


class PartenaireGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetSecteur()
    {
        $secteurs=Secteur::select('id','nom')->get();
        return response()->json($secteurs);
    }
    public function GetPartenaire($id)
    {
        $partenaires=Partenaire::where('secteur_id',$id)->select('nom','adress','profession_id','specialite_id')->get();
        return response()->json($partenaires);
    }
    public function GetProfession(GetProfessionRequest $request)
    {
        
        $profession=Profession::select('nom')->findorfail($request->id);
        return response()->json($profession);
    }
    public function GetSpecialite(GetSpecialiteRequest $request)
    {
       
        $specialites=Specialite::select('nom')->findorfail($request->id);
        return response()->json($specialites);
    }
    public function FilterGov(FilterGovRequest $request){
       
        $partenaires=Partenaire::where('gov_id',$request->id)->where('secteur_id',$request->secteur_id)->get();
        return response()->json($partenaires);
    }
    /**
     * Store a newly created resource in storage.
     */
    
}
