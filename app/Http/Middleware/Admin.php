<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::user()->nom);
        if (Auth::user()->fonction == "admin") {
           return $next($request);
        } else {
            return abort('403',"Vous n'êtes pas accrédité à accéder à cette page");
        }
    }
}
