<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use App\User;
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $redirect;
            $user = Auth::user();
            if($user->type === 1) {
                $redirect = '/cliHome';
            } else {
                $redirect = '/assHome';
            }
            return redirect($redirect);
        }

        return $next($request);
    }
}
