<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdherentStoreRequest;
use App\Http\Requests\Admin\AdherentUpdateRequest;
use Illuminate\Http\Request;
use Auth;
use Str;
use Illuminate\Support\Facades\Mail;
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
use Illuminate\Database\QueryException;

use App\Models\Gouvernorat;

class AdherentAdminController extends Controller
{

    function AdherentStore(AdherentStoreRequest $request){
   try {
   
  
        $carte=Carte::findorfail($request->carte_id);
        if ($carte->amicale_id==$request->amicale_id) {
            $carte->is_active=1;
            $carte->update();
            $adherent = new Adherent();
            $password=Str::random(8);
            $mail_data=[
                'recipient'=>$request->email,
                'fromEmail'=>'azizbenamor1288@gmail.com', //a changer Yooreed@contact.com
                'fromName'=>'Yooreed',
                'subject'=>"Votre compte en tant qu'adhérent",
                'body'=> $password
            ];
            Mail::send('emailTemplate/AdherentPassword', $mail_data, function ($message) use ($mail_data) {
                $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'],'Yooreed')
                ->subject($mail_data['subject']);
            });
            $adherent->nom=$request->nom;
            $adherent->email=$request->email;
            $adherent->tel=$request->tel;
            $adherent->cin=$request->cin;
            $adherent->gov_id=$request->gov_id;
            $adherent->ville_id=$request->ville_id;
            $adherent->adress=$request->adress;
            $adherent->amicale_id=$request->amicale_id;
            $adherent->carte_id=$request->carte_id;
            $adherent->password=Hash::make($password);
            $adherent->save();
           
            return redirect()->back()->with('successAdherent','Adhérent ajouté avec succès');
            } else {
            
                return redirect()->back()->with('errorAdherent',"la carte n'est pas affectée à l'amicale");
        }
    } catch (QueryException $e) {
        return redirect()->back()->with('errorAdherent','la carte est utilisée');
       }

    }
    function ImportAdhernet(){
        request()->validate([
            'import'=>'required|mimes:xlsx'
        ]);
        try{
        try {
            Excel::import(new AdherentsImport(),request()->file('import') );
            return redirect()->route('admin.AdherentActiveIndex')->withMessage('importé avec succès');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             return redirect()->route('admin.AdherentActiveIndex')->with('import_errors',$failures);
             foreach ($failures as $failure) {
              
                 $failure->row(); // row that went wrong
                 $failure->attribute(); // either heading key (if using heading row concern) or column index
                 $failure->errors(); // Actual error messages from Laravel validator
                 $failure->values(); // The values of the row that has failed.
             }
        }} catch(QueryException $e) {
        
            return redirect()->route('admin.AdherentActiveIndex')->with('import_error',"la carte est déjà utilisée ou n'est pas affectée à l'amicale.");

        }
    }

 
 
    function UpdateAdherent(AdherentUpdateRequest $request,$idadherent){
       
        $adherent = Adherent::findorfail($idadherent);
        if ($request->cin!=$adherent->cinU) {
            $request->validate([
                'cinU'=>'required|numeric|digits:8|unique:adherents,cin,',
            ],[
                'cinU.required' => 'Le champ CIN est requis.',
                'cinU.numeric' => 'Le champ CIN doit être un nombre.',
                'cinU.digits' => 'Le champ CIN doit contenir :8 chiffres.',
                'cinU.unique' => 'Ce numéro de CIN est déjà utilisé par un autre adherent.',
            ]);
        }
        $adherent->nom=$request->nomU;
        $adherent->adress=$request->adressU;
        $adherent->tel=$request->telU;
        $adherent->cin=$request->cinU;
        if ($request->carte_idU) {
            $carte=Carte::findorfail($request->carte_idU);
        }
        if (!$request->carte_idU) {
            $carte=Carte::findorfail($adherent->carte_id);
        }
        if ($request->amicale_idU) {
            $carte->amicale_id=$request->amicale_idU;
            $carte->update();
            $adherent->amicale_id=$request->amicale_idU;
        }
        if ($request->carte_idU) {
            if (!$request->amicale_idU) {
                
            $carte->amicale_id=$adherent->amicale_id;
            $carte->update();
            }
           
            $adherent->carte_id=$request->carte_idU;
           
        }
       
      
       
        $adherent->update();
        return redirect()->back()->with('successAdherent','Adherent est modifier avec succès');
    
    }
    
    function destroyAdherent($idadherent){
    $adherent = Adherent::find($idadherent);
    $adherent->delete();
    return redirect()->back()->with('successAdherent',"l'adherent a été supprimée avec succès");
    }
    function AdherentIndex( $idamicale){
            
        $amicale= Amicale::find($idamicale);
        $amicales=Amicale::all();
        $cartes = Carte::where('amicale_id',$idamicale)->get();
        $causes = Cause::all();
        $adherents= Adherent::latest()->where('amicale_id',$idamicale)->paginate(5);
        $carteAddIds = [];
        foreach ($cartes as $carte) {
            $found = false;
            foreach ($adherents as $value) {
                if ($value->carte_id == $carte->id) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $carteAddIds[] = $carte->id;
            }
        }
        $carteAdd = Carte::whereIn('id', $carteAddIds)->get();
        $gouvernorats=Gouvernorat::all();
        $villes=Ville::all();
        return view('dashboard.admin.amicale.adherent',compact('amicales','adherents','amicale','cartes','causes','gouvernorats','villes','carteAdd'));
    }
    
    function AdherentActiveIndex(){
        $cartes = Carte::all()->where('is_active',1);
        $causes = Cause::all();
        $gouvernorats=Gouvernorat::all();
        $villes=Ville::all();
        $adherents= Adherent::latest()->paginate(5);
        $amicale= Amicale::all();
        
        return view('dashboard.admin.adherent.adherent',compact('adherents','cartes','amicale','causes','villes','gouvernorats'));
    }
    function AdherentBloquerIndex(){
        $cartes = Carte::all()->where('is_active',0);
        $causes = Cause::all();
        $gouvernorats=Gouvernorat::all();
        $villes=Ville::all();
        $adherents= Adherent::latest()->paginate(5);
        $amicale= Amicale::all();
        
        return view('dashboard.admin.adherent.adherentblock',compact('adherents','cartes','amicale','causes','villes','gouvernorats'));
    }
    function SearchAdherent(Request $request)
    {
        
       $adherents = Adherent::where('nom','LIKE','%'.$request->adherent_nom.'%')->paginate(5);
       $cartes = Carte::all();
       $amicale= Amicale::all();
       $causes=Cause::all();
        $gouvernorats=Gouvernorat::all();
        $villes=Ville::all();
       return view('dashboard.admin.amicale.adherentsearch',compact('adherents','cartes','amicale','causes','villes','gouvernorats'));
    }
}