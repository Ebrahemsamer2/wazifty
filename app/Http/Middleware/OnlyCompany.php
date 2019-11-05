<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OnlyCompany
{
    
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if(auth()->user()->emp_type == "employer") {
                return $next($request);
            }
        }
        return abort(404);
    }
}
