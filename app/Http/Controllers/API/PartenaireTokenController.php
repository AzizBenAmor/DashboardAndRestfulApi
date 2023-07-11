<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Partenaire\LoginRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Auth\AuthenticationException;

class PartenaireTokenController extends Controller
{
    public function store(LoginRequest $request){
        $creds = $request->only('email','password');

        if( !Auth::guard('partenaire')->attempt($creds) ){
            return  response()->json(['message' =>'Faux identifiant']);
    }
    return[
        'token'=>auth()->guard('partenaire')->user()->createToken('partenaire')->plainTextToken
    ];
    }  
    function logout(){
        auth()->user()->tokens()->delete();
        return response()->json('se déconnecter avec succès');
    }
}