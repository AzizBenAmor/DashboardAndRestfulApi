<?php

namespace App\Http\Controllers\Admin;
use App\Imports\CartesImport;
use App\Imports\AdherentsImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminLoginRequest;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use Hash;
use Carbon\Carbon;
use App\Models\Amicale;
use App\Models\Partenaire;
use App\Models\Secteur;
use App\Models\Profession;
use App\Models\Offer;
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
use Illuminate\Support\Facades\DB;
use App\Models\Gouvernorat;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $amicale=Amicale::all();
        $adherent=Adherent::all();
        $partenaire=Partenaire::all();
        $am=DB::table('amicales')->where('deleted_at',null)->count();
        $ad=DB::table('adherents')->where('deleted_at',null)->count();
        $pa=DB::table('partenaires')->where('deleted_at',null)->count();
        $data=Transaction::oldest()->select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M-Y');
        });

        $months=[];
        $monthCount=[];
        foreach($data as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }
        return view('dashboard.admin.home',compact('am','ad','pa','data','months','monthCount'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $admin=Auth()->user();
        return view('dashboard.admin.changePassword',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasswordRequest $request)
    {
        $admin=  Admin::findOrFail(auth()->user()->id);
    
        $admin->update([
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->route('admin.home')->with('success','Mot De Passe Est Changer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function check(AdminLoginRequest $request){
  
    
        $creds = $request->only('email','password');

        if( Auth::guard('admin')->attempt($creds) ){
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.login')->with('fail','Incorrect credentials');
        }
   }
  

   function logout(){
    Auth::guard('admin')->logout();
    return redirect('/');
}


}