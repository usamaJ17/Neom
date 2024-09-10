<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->check()) {
            if(auth()->guard('admin')->user()->role_id == 0){
            return to_route('admin.dashboard');
            }
            else{
                return to_route('admin.authorization');
            }
        }
        return $next($request);
    }
}
