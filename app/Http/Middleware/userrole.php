<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userrole
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
        //return $next($request);
	    //The following line(s) will be specific to your project, and depend on whatever you need as an authentication.
        $isAuthenticatedAdmin = (Auth::check() && Auth::user()->user_role == "Admin");
        //This will be excecuted if the new authentication fails.
        if (! $isAuthenticatedAdmin)
        {
            return redirect('/deptlogin')->with('message', 'Authentication Error.');
        }
        return $next($request);
    }
}
