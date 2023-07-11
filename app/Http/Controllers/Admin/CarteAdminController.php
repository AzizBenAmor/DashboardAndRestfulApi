<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddAmicaleToCarteRequest;
use App\Http\Requests\Admin\CarteStoreRequest;
use Illuminate\Http\Request;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use App\Models\Amicale;
use App\Models\Partenaire;
use App\Models\Secteur;
use Carbon\Carbon;
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
use App\Models\Offer;
use App\Models\Cause;

use App\Models\Gouvernorat;
use Exception;
use Illuminate\Support\Facades\DB;

class CarteAdminController extends Controller
{
  //Carte Method-------------------------------------------------------------

  function CarteStore(CarteStoreRequest $request){
  
    $carte=new Carte(); 
    $carte->codeBar=$request->codeBar;
    if ($request->amicale_id) {
      $carte->amicale_id=$request->amicale_id;
    }
    $carte->cause_id=3;
    $carte->date=Carbon::today();
    $carte->is_active=0;
    $carte->save();
    return redirect()->back()->with('Affectation',"la carte a été ajouter avec succès");
  }

  function Carteblock($idcarte,Request $request){
    $carte= Carte::find($idcarte);
    $carte->is_active= false;
    $carte->cause_id= $request->cause_id;
    $carte->update();
    return redirect()->back()->with('Affectation',"la carte a été bloquer avec succès");
}
function CarteUnblock($idcarte){
    $carte= Carte::find($idcarte);
    $carte->is_active= true;
    $carte->cause_id= null;
    $carte->update();
    return redirect()->back()->with('Affectation',"la carte a été débloquer avec succès");
}
   function importCarte(){
    request()->validate([
      'import'=>'required|mimes:xlsx']);
      try {
    Excel::import(new CartesImport(), request()->file('import'));
    return redirect()->route('admin.Carte')->withMessage('successfully imported');
  } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
    $failures = $e->failures();
    return redirect()->route('admin.Carte')->with('import_errors',$failures);
    return redirect()->back()->with('import_errors',$failures);
    foreach ($failures as $failure) {
        $failure->row(); // row that went wrong
        $failure->attribute(); // either heading key (if using heading row concern) or column index
        $failure->errors(); // Actual error messages from Laravel validator
        $failure->values(); // The values of the row that has failed.
    }
}
   }     

  function CarteIndex(){
  
    
    $cartes= Carte::latest()->paginate(5);
    $amicale=Amicale::all();
    $causes=Cause::all(); 
    return view('dashboard.admin.carte.index',compact('cartes','causes','amicale'));
  }
  function destroyCarte($idcarte){
    $adherent=Adherent::all();
    $carte = Carte::findorfail($idcarte);
    foreach ($adherent as $key => $a) {
      if ($a->carte_id==$carte->id) {
        return redirect()->back()->with('errorAffectation',"la carte ne peux pas etre supprimer puisque elle est utilise");
      }
    }
    $carte->delete();
    return redirect()->back()->with('Affectation',"la carte a été supprimer avec succès");
    }
    function SearchCarte(Request $request)
    {
       $cartes = Carte::where('codeBar','LIKE','%'.$request->id.'%')->paginate(5);
       $causes= Cause::all();
       $amicale=Amicale::all();  
       return view('dashboard.admin.carte.index',compact('cartes','causes','amicale'));
    }
    // function AddAmicaleToCarte(AddAmicaleToCarteRequest $request){
    
    //   $cartes=Carte::whereBetween('id', [$request->minid, $request->maxid])->get();
   
    //   foreach ($cartes as $key => $c) {
    //     if ($c->amicale_id != null || $c->amicale_id!=$request->amicale) {
    //       return back()->with('errorAffectation',"the affectation stoped at cartes '  $c->id ' beacause it's used ");
    //      }
    //       $c->amicale_id=$request->amicale;
    //       $c->update();
    //     }
    //     return redirect()->route('admin.Carte')->with('Affectation',"la carte a été affecter avec succès");
    // }
   

function AddAmicaleToCarte(AddAmicaleToCarteRequest $request)
{
    DB::beginTransaction();

    try {
        $cartes = Carte::whereBetween('id', [$request->minid, $request->maxid])
            ->lockForUpdate()
            ->get();

        foreach ($cartes as $key => $c) {
            $c->amicale_id = $request->amicale;
            $c->update();
        }

        DB::commit();

        return redirect()->route('admin.Carte')->with('Affectation', "The card has been successfully assigned.");
    } catch (Exception $e) {
        DB::rollback();
        throw $e;
    }
}
    function AffectAmicale(Request $request,$carteid){
      $request->validate([
        'amicale'=>'required'
      ],[
        'amicale.required'=>'ce champ est requis'
      ]);
      $carte=Carte::findorfail($carteid);
      $carte->amicale_id=$request->amicale;
      $carte->update();
      return back()->with('Affectation','la carte a été affecter avec succès');

    }
}
