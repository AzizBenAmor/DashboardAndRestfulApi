<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSingleSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $previous_session= \Auth::guard('admin')->user()->session_id;
        if ($previous_session !== \Session::getId()) {
          \Session::getHandler()->destroy($previous_session);
          $request->session()->regenerate();
          \Auth::guard('admin')->user()->session_id = \Session::getId();
          \Auth::guard('admin')->user()->save();
        }
        return $next($request);
    }
}
