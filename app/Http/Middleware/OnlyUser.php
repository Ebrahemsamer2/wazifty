<?php

namespace App\Http\Middleware;

use Closure;

class OnlyUser
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
        if(auth()->user()->emp_type == "employer") {
            abort(404);
        }
        return $next($request);
    }
}
