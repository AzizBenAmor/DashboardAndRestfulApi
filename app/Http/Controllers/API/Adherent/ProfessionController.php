<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetProfession()
    {
        $profession=Profession::all();
        return response()->json($profession) ;
    }
   
}
