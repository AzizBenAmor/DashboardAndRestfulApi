<?php

namespace App\Http\Controllers\API\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amicale;
use App\Models\Partenaire;
use App\Models\Adherent;
use Illuminate\Support\Facades\DB;

class StatisticGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function StatisticAdherent()
    {
        $nb_adherent=DB::table('adherents')->count();

        return response()->json($nb_adherent);
    }
    public function StatisticAmicale()
    {

        $nb_amicale=DB::table('amicales')->count();
  
        return response()->json($nb_amicale);
    }

    public function StatisticPartenaire()
    {
      
        $nb_partenaire=DB::table('partenaires')->count();
        return response()->json($nb_partenaire);
    }

   
}
