<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Assessor;
use App\Etiqueta;
use App\Assessoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function indexCli(Request $request)
    {
        $users = User::where('type', '=', 2)->get();
        $etiquetes = Etiqueta::all();
        
        return view('cliHome')->with(array('users' => $users, 'etiquetes' => $etiquetes, 'message' => $request->input('message'), 'messageType' => $request->input('messageType')));
    }
    public function searchAss(Request $request){
        $search = $request->input('search');
        $etiquetes = Etiqueta::all();
        
        $users = User::where('type', '=', 2)
            ->where('name', 'LIKE', "%{$search}%" )
            ->get();
        

        return view('cliHome')->with(array('users' => $users, 'etiquetes' => $etiquetes));
    }

    public function indexAss()
    {
        $asse = auth()->user()->assessor;
        $asse = Assessoria::whereDate('data_inici', '<=', Carbon::now())
        ->whereDate('data_fi', '>', Carbon::now())
        ->where('assessor_id', '=', $asse->id)->get();
        
        return view('assHome')->with(array('asse' => $asse));
    }
}
