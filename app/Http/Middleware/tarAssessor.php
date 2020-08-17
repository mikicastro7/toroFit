<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Assessor;
use App\Tarifa;

class tarAssessor
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
        $tar = Tarifa::where('id', 'like', $request->route('id'))->first();
        $user = auth()->user();

        if($user->assessor->id == $tar->assessor_id){
            return $next($request);
        }

        return redirect()->back();
        
    }
}
