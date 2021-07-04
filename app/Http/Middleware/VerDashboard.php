<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerDashboard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if (!Auth::user()->rol->esExterno()) {
                return $next($request);
            } else{
                return redirect()->route('consulta.index');
            }
        } else{
            return redirect()->route('landing.index');
        }
        
    }
}
