<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PubliciteRequest;
use Illuminate\Http\Request;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use App\Models\Amicale;
use App\Models\Partenaire;
use App\Models\Secteur;
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
use App\Models\Cause;
use App\Models\Publicite;
use App\Models\Gouvernorat;
use App\Models\Offer;

class PubliciteAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function SearchPublicite(Request $request)
    {
       $publicites = Publicite::where('owner','LIKE','%'.$request->publicite_nom.'%')->paginate(5);  
       return view('dashboard.admin.publicite.index',compact('publicites'));
    }
    public function indexPublicite()
    {
        $publicites=Publicite::latest()->paginate(5);
        return view('dashboard.admin.publicite.index',compact('publicites'));
    }

 
    /**
     * Store a newly created resource in storage.
     */
    public function storePublicite(PubliciteRequest $request)
    {
 
       $filename=uniqid();
       $file=$request->file('file'); 
       $filename .= "." . $file->getClientOriginalExtension();
       $destinationPath = 'uploads';
       $file->move($destinationPath, $filename);
       $publicite= new Publicite();
       $publicite->owner=$request->owner;
       $publicite->dateDebut=$request->dateDebut;
       $publicite->dateFin=$request->dateFin;
       $publicite->file=$filename;
       $publicite->save();
       return redirect()->back()->with('success','Publicite a été ajouter avec succès');
    }


    function PublicitePost($idpub){
        $publicite=Publicite::findorfail($idpub);
        $publicite->post = true;
        $publicite->update();
        return redirect()->back()->with('success','Publicite a été poster avec succès');
    }
    function PubliciteUnPost($idpub){
        $publicite=Publicite::findorfail($idpub);
        $publicite->post = false;
        $publicite->update();
        return redirect()->back()->with('success','Publicite a été archiver avec succès');
    }
    function PubliciteDelete($idpub){
        $publicite = Publicite::find($idpub);
        $publicite->delete();
        return redirect()->back()->with('success','Publicite a été supprimer avec succès');
    }
}
