<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Etiqueta;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Assessor;
use App\AssessorEtiqueta;
use Log;
use Illuminate\Support\Facades\Storage;
class UsersConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function userConfig(){

        $user = auth()->user();
        return view('configurationUser')->with(array('user' => $user));
    }
    public function assConf(){
        $user = auth()->user();
        //dd($user->assessor->etiquetas);
        $etiquetes = Etiqueta::all();
        return view('configurationAss')->with(array('etiquetes' => $etiquetes, 'user' => $user));
    }

    public function editUser(Request $request){

        $user = auth()->user();
        $userName = $request->input('name');
        $userMail = $request->input('email');
        $userPass = $request->input('password');
        $userPassCon = $request->input('confirmPassword');
        Log::debug($request->input('image'));

        $nameExists = User::where('name', 'like', $userName)->count();
        $mailExists = User::where('email', 'like', $userMail)->count();

        if($nameExists > 0 && $userName != $user->name){
            return response()->json(['error' => "El nom de usuari ja existeix"], 500);
        } else if ($userName == null){
            return response()->json(['error' => "No has escrit el nom de usuari"], 500);
        } else {
            $user->name = $userName;
        }

        if($mailExists > 0 && $userMail != $user->email){
            return response()->json(['error' => "El correu ja existeix"], 500);
        } else if ($userMail == null){
            return response()->json(['error' => "No has escrit el correu"], 500);
        } else {
            $user->email = $userMail;
        }
        if(strlen($userPass) < 8){
            if($userPass != null){
                return response()->json(['error' => "La contrasenya a de tenir més de 8 caràcters "], 500);
            }
        } else if ($userPass == $userPassCon) {
            $user->password = bcrypt($userPass);
        }

        

        $user->save();

        $notification = array(
            'message' => 'Usuari editat',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);

    }

    public function editAss(Request $request){
        if($request->input('etiquetes') == null){
            return response()->json(['error' => "Has de seleccionar un mínim  de una etiqueta"], 500);
        }
        if($request->input('description') == null){
            return response()->json(['error' => "Has de escriure algo sobre tu a la descripció"], 500);
        } 
        if(strlen($request->input('description')) > 140){
            return response()->json(['error' => "La descripció no pot passar de 140 caràcters"], 500);
        }

        $user = auth()->user();
        $ass = Assessor::where('user_id', $user->id)->first();
        if($ass == null){
            $ass = new Assessor;
        }

        $ass->description = $request->input('description');
        $ass->avgRating = rand(1,5);
        $ass->user_id = $user->id;
        $ass->save();

        $etActuals = AssessorEtiqueta::where('assessor_id', $ass->id)->get();
        $etActualsId = array();
        for($i = 0; $i < count($etActuals); $i++){
            array_push($etActualsId, $etActuals[$i]->etiqueta_id);
        }

        Log::debug($etActualsId);
        
        foreach($request->input('etiquetes') as $ets){
            $etexist = AssessorEtiqueta::where('etiqueta_id', $ets)->where('assessor_id', $ass->id)->first();
            if($etexist == null){
                $et = new AssessorEtiqueta;
                $et->etiqueta_id = intval($ets);
                $et->assessor_id = $ass->id;
                $et->save();
            }
        }
        for($i = 0; $i < count($etActualsId); $i++){
            $found = false;
            foreach($request->input('etiquetes') as $ets){
                Log::debug("ets ".$ets);
                Log::debug("ets actual ".$etActualsId[$i]);
                if($etActualsId[$i] == $ets){
                    $found = true;
                    break;
                }
                
            }
            if($found == false){
                AssessorEtiqueta::where('etiqueta_id', $etActualsId[$i])->where('assessor_id', $ass->id)->delete();
            }
        }

        $notification = array(
            'message' => 'Dades guardades',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);




    }

    public function editUserImage(Request $request){
        $this->validate($request, [
            'perfil_image' => 'image|nullable|max:6000'

        ]);
        $user = auth()->user();

        if($request->hasFile('perfil_image')){
            $filenameWithExt = $request->file('perfil_image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('perfil_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('perfil_image')->storeAs('public/perfil_image', $fileNameToStore);
            if($user->perfil_image != "default.jpg"){
                Storage::delete('public/perfil_image/'.$user->perfil_image);
            }
        } else {
            $fileNameToStore = $user->perfil_image;
        }
        Log::debug($request);

        $user->perfil_image = $fileNameToStore;
        $user->save();

        return redirect()->back();
    }
}
