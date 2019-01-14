<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(\Auth::user() != null){
            if (\Auth::user()->role == $role) {
                return $next($request);
            }
        }

        return redirect('dashboard');
    }
}
