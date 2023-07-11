<?php

namespace App\Http\Controllers\API\Adherent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gouvernorat;
class GovernoratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetGov()
    {
        $gov=Gouvernorat::all();
        return response()->json($gov) ;
    }


}
