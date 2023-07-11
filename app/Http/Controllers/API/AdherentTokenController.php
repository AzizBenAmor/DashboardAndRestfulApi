<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adherent\LoginRequest;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Auth\AuthenticationException;

class AdherentTokenController extends Controller
{
    public function store(LoginRequest $request){
       
        $creds = $request->only('email','password');

        if( !Auth::guard('adherent')->attempt($creds) ){
            return  response()->json(['message' =>'Faux identifiant']);
    }
    return[
        'token'=>auth()->guard('adherent')->user()->createToken('adherent')->plainTextToken
    ];
    }  
    function logout(){
        auth()->user()->tokens()->delete();
        return response([
            'se déconnecter avec succès'
        ],200);
    }
}
