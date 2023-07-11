<?php

namespace App\Http\Middleware\Partenaire;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PasswordChangedPartenaire
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->changed_password){
            return $next($request);
        }else {
            return redirect()->route('partenaire.change');
        }
    }
}
