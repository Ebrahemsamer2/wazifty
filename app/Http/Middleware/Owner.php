<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

class Owner
{

    public function handle($request, Closure $next)
    {
        // check if he is an admin and owner of this website
        if(Auth::check()) {
            if(Auth::user()->admin == 1) {
                if(Auth::user()->email === 'Soltan_Algaram41@yahoo.com') {
                    return $next($request);
                }
            }
        }
        // if he is not 
        return abort(404);
    }
}
