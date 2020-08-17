<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Assessor;
use Illuminate\Support\Facades\Auth;

class isAss
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
        if(Auth::user()->type == 2){
            return $next($request);
        }
        return redirect()->back();

        

    }
}
