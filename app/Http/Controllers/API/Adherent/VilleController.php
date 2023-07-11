<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ville;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetVille()
    {
        $ville=Ville::all();
        return response()->json(
            $ville
        ) ;
    }

   
}
