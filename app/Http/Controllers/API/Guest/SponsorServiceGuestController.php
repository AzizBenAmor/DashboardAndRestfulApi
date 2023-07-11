<?php

namespace App\Http\Controllers\API\Guest;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorServiceGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function GetService()
    {
        $services=Services::all();
        return response()->json($services);
    }

    public function GetSponsor()
    {
        $sponsors=Sponsor::all();
        return response()->json($sponsors);
    }
   
}
