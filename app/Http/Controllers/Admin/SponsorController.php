<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SponsorStoreRequest;
use App\Http\Requests\Admin\SponsorUpdateRequest;
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
use App\Models\Offer;
use App\models\Sponsor;
use App\Models\Gouvernorat;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sponsors=Sponsor::latest()->paginate(5);
        return view('dashboard.admin.sponsor.index',compact('sponsors'));
    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(SponsorStoreRequest $request)
    {
    
            $newname = uniqid();
            $image = $request->file('photo');
            $newnamee= $newname;
            $newnamee .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newnamee);
            $sponsor= new Sponsor();
        
        $sponsor->nom=$request->nom;
        $sponsor->link=$request->link;
        $sponsor->image=$newnamee;
        $sponsor->save();
        return redirect()->back()->with('success','Sponsor a été ajouter avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(SponsorUpdateRequest $request, string $id)
    {
        $sponsor=Sponsor::findorfail($id);
        $sponsor->nom=$request->nomU;
        $sponsor->link=$request->linkU;
      
      if ($request->photoU) {
           $file_path=public_path().'/uploads/'.$sponsor->image;
           if (file_exists($file_path)) {
            unlink($file_path);
           }
           $newname = uniqid();
           $image = $request->file('photoU');
           $newnamee= $newname;
           $newnamee .= "." . $image->getClientOriginalExtension();
           $destinationPath = 'uploads';
           $image->move($destinationPath, $newnamee);
           $sponsor->image=$newnamee; }
           $sponsor->update();
        return redirect()->route('admin.sponsorIndex')->with('success','Sponsor a été modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sponsor=Sponsor::findorfail($id);
        $file_path=public_path().'/uploads/'.$sponsor->image;
        unlink($file_path);
        $sponsor->delete();
        return redirect()->back()->with('success','Sponsor a été supprimer avec succès');
    }
    function SearchSponsor(Request $request)
    {
       $sponsors = Sponsor::where('nom','LIKE','%'.$request->secteur.'%')->paginate(5);  
       return view('dashboard.admin.sponsor.index',compact('sponsors'));
    }
}
