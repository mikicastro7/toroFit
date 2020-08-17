<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Assessor;
use App\Etiqueta;
use App\PerfilAssessor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DB;

class PerfilAssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function perfilAss(){
        $user = auth()->user();

        return view('perfilAss')->with('user', $user);
    }

    public function perfilAssEditor(){
        $user = auth()->user();

        return view('perfilAssEditor')->with('user', $user);
    }

    public function perfilAssEditorEditar(Request $request){
        $ass = auth()->user()->assessor;
        $perf = PerfilAssessor::where('assessor_id', $ass->id)->first();

        if($perf == null){
            $perf = new PerfilAssessor;
            $perf->assessor_id = $ass->id;
        }

        $perf->body = $request->input('body');
        
        $perf->save();
        $notification = array(
            'message' => 'Canvis guardats',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);

    }

    public function perfilAssClient(Request $request){

        $user = User::where('id', $request->route('id'))->first();
        
        return view('perfilAssCli')->with('user', $user);
    }

}
