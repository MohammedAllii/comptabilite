<?php

namespace App\Http\Middleware;
use Auth;


use Closure;

class Admin
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

        if ($request->user() && $request->user()->isAdmin()) {
            return redirect('/');
        }
            return redirect('/login');

        


    }
}
