<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NotificationRequest;
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
use App\Models\Gouvernorat;
use App\Models\Offer;

class NotificationAdminController extends Controller
{
   //--------------------------------Notification--------------------------------------------
   function SearchNotification(Request $request)
   {
      $notifications = Notification::where('nom','LIKE','%'.$request->notification_nom.'%')->paginate(5);
      $partenaires=Partenaire::all();
      return view('dashboard.admin.notification.index',compact('notifications','partenaires')) ;
   }
 
    function NotificationIndex(){
        $notifications=Notification::latest()->paginate();
        $partenaires=Partenaire::all();
        return view('dashboard.admin.notification.index',compact('notifications','partenaires'));
    }
    function NotificationStore(NotificationRequest $request){
    
     
        
            $newname = uniqid();
            $image = $request->file('photo');
            $newnamee= $newname;
            $newnamee .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newnamee);
        
          
            $notification= new Notification();
        
        $notification->nom=$request->nom;
        $notification->lien=$request->lien;
        $notification->description=$request->description;
        $notification->image=$newnamee;
        $notification->partenaire_id=$request->partenaire_id;
        $notification->dateDebut=$request->dateDebut;
        $notification->save();
        return redirect()->back()->with('success',"Notification a été ajouter avec succès");
        }
        function NotificationDelete($idnotification){
            $notification = Notification::find($idnotification);
            $notification->delete();
            return redirect()->back()->with('success',"Notification a été supprimer avec succès");
        }  

}
