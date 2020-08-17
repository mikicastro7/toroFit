<?php

namespace App\Http\Middleware;

use Closure;
use App\Assessoria;
use App\User;
use App\Assessor;

class assAssessoria
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
        $asse = Assessoria::where('id', '=', $request->route('id'))->first();

        $user = auth()->user();
        
        if($asse->assessor_id == $user->assessor->id){
            return $next($request);
        }
        return redirect()->back();
    }
}
