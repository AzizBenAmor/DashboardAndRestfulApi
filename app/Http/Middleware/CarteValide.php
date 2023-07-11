<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\Carte;
class CarteValide
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        $carte=Carte::findorfail(Auth::user()->carte_id);
        if(!$carte->is_active){
            return $next($request);
        }else {
            return redirect()->route("adherent.home");
        }
    }
}
