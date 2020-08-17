<?php

namespace App\Http\Middleware;

use Closure;
use App\Assessoria;
use App\User;
use App\Assessor;

class fileAcces
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
        $asse = Assessoria::where('image', '=', $request->route('file'))
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
       // dd($asse);
        
    }
}
