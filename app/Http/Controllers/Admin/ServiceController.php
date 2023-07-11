<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceStoreRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest;
use App\Models\Services;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services=Services::latest()->paginate(5);
        return view('dashboard.admin.service.index',compact('services'));
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
    public function store(ServiceStoreRequest $request)
    {
            $newname = uniqid();
            $image = $request->file('photo');
            $newnamee= $newname;
            $newnamee .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newnamee);
            $service= new Services();
        
        $service->titre=$request->titre;
        $service->description=$request->description;
        $service->image=$newnamee;
        $service->save();
        return redirect()->back()->with('success','Service a été ajouter avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Services $services)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Services $services)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, $id)
    {
       $services=Services::findorfail($id);
        $services->titre=$request->titreU;
        $services->description=$request->descriptionU;
     
      if ($request->photoU) {
           $file_path=public_path().'/uploads/'.$services->image;
           if (file_exists($file_path)) {
            unlink($file_path);
           }
           $newname = uniqid();
           $image = $request->file('photoU');
           $newnamee= $newname;
           $newnamee .= "." . $image->getClientOriginalExtension();
           $destinationPath = 'uploads';
           $image->move($destinationPath, $newnamee);
           $services->image=$newnamee; }
           $services->update();
        return redirect()->route('admin.serviceIndex')->with('success','Service a été modifier avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $service=Services::findorfail($id);
        $service->delete();
        return redirect()->back()->with('success','Service a été supprimer avec succès');
    }
    function SearchService(Request $request)
    {
       $services = Services::where('titre','LIKE','%'.$request->secteur.'%')->paginate(5);  
       return view('dashboard.admin.service.index',compact('services'));
    }
}
