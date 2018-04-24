<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (\Auth::user()->role == 'admin') {
                return redirect('/users');
                // or return route('routename');
            }
            else if(\Auth::user()->role == 'mobile-user'){
                return redirect('/mypostlist');
            }
            else if(\Auth::user()->role == 'manager'){
                return redirect('/users');
            }

        }

        return $next($request);
    }
}
