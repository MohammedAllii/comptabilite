<?php

namespace App\Http\Middleware;
use Auth;


use Closure;

class SuperAdmin
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

        if ($request->user() && ($request->user()->isAdmin() || $request->user()->isSuperadmin())) {
            return $next($request);
        
        }else{
            return redirect('/login');

        }


        


    }
}
