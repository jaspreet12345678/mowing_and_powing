<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,$guard)
    {
        if(!auth()->guard($guard)->check()){
            return redirect(route($guard.'.login'));
        }

        View::share('activeGuard',$guard);
        View::share('activeUser',auth()->guard($guard)->user());

        return $next($request);
    }
}
