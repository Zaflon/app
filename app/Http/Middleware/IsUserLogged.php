<?php

namespace App\Http\Middleware;

class IsUserLogged
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * 
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ((int) count((array)\App\Helpers\Utils::user()) > 0) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }
    }
}
