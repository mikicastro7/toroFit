<?php

namespace App\Http\Middleware;
use App\Assessoria;
use App\User;
use App\Assessor;

use Closure;

class AssessorGetHistory
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
        $asse = Assessoria::where('user_id', '=', $request->route('id'))
        ->first();
        if($asse == null){
            return redirect()->back();
        }
        $user = auth()->user();
        if($user->assessor == null && $asse->user_id == $user->id){
            return $next($request);
        }
        if($asse->assessor_id == $user->assessor->id){
            return $next($request);
        }
        return redirect()->back();
    }
}
