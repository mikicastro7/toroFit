<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Assessor;
use App\Tarifa;
use App\Etiqueta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TarifasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexTarifes(){

        $tar = Tarifa::where('assessor_id', auth()->user()->assessor->id)->get();
        Log::debug(time());
        
        return view('tarifas.mostrarTarifas')->with(array('tar' => $tar));
        
    }
    public function creadorTarifes(){


        return view('tarifas.creadorTarifas');
    }
    public function editadorTarifa(Request $request){

        $tar = Tarifa::where('id', $request->route('id'))->first();

        return view('tarifas.editarTarifas')->with(array('tar' => $tar));
    }

    public function crearTarifa(Request $request){
        $tarifa = new Tarifa;
        $tarifa->title = $request->input('titol');
        $tarifa->duration = $request->input('duracio');
        $tarifa->description = $request->input('descripcio');
        $tarifa->title = $request->input('titol');
        $tarifa->caracteristiques = serialize($request->input('carac'));
        $tarifa->price = $request->input('preu');
        $tarifa->assessor_id = auth()->user()->assessor->id;

        $tarifa->save();

        $notification = array(
            'message' => 'Tarifa Creada',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }
    public function editarTarifa(Request $request){

        $tarifa = Tarifa::where('id', $request->route('id'))->first();

        $tarifa->title = $request->input('titol');
        $tarifa->duration = $request->input('duracio');
        $tarifa->description = $request->input('descripcio');
        $tarifa->title = $request->input('titol');
        $tarifa->caracteristiques = serialize($request->input('carac'));
        $tarifa->price = $request->input('preu');

        $tarifa->save();

        $notification = array(
            'message' => 'Tarifa Creada',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }
    public function eliminarTarifa(Request $request){
        
        $tarifa = Tarifa::where('id', $request->input('id'))->first(); 
        
        Log::debug($tarifa);
        $tarifa->delete();

        $notification = array(
            'message' => 'Tarifa Eliminada',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }

    public function mostrarTarifaCli(Request $request){
        $user = User::where('id', $request->route('id'))->first();

        return view('tarifas.mostrarTarifasCli')->with('user', $user);
    }

}
