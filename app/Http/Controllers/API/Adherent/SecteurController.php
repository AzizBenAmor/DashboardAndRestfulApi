<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Secteur;

class SecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetSecteur()
    {
        $secteur=Secteur::all();
        return response()->json($secteur) ;
    }
   
}
