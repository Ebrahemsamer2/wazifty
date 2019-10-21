<?php

namespace App\Http\Middleware;

use Closure;

class Localization
{

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
