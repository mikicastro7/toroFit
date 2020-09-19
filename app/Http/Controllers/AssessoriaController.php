<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assessoria;
use App\Assessor;
use App\Rating;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class AssessoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function cliAssessoriaHome(){

        return view('assessoria.cliAssHome');
    }

    public function cliAssessoriaEntrarDades(){

        $asse = Assessoria::whereDate('data_inici', '<=', Carbon::now())
            ->whereDate('data_fi', '>', Carbon::now())
            ->where('user_id', '=', auth()->user()->id)->first();

        return view('assessoria.cliAssEntrarDades')->with(array('asse' => $asse));
    }
    public function cliAssessoriaEntrarDadesEdit(REQUEST $request){
        $this->validate($request, [
            'image' => 'image|nullable|max:6000' 
        ]);

        $asse = Assessoria::whereDate('data_inici', '<=', Carbon::now())
            ->whereDate('data_fi', '>', Carbon::now())
            ->where('user_id', '=', auth()->user()->id)->first();


        
            if($request->hasFile('image')){
                $filenameWithExt = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
                $path = $request->file('image')->storeAs('private/progress_images/', $fileNameToStore);
                if($asse->image != null){
                    Storage::delete('private/progress_images/'.$asse->image);
                }
            } else {
                $fileNameToStore = $asse->image;
            }

            $asse->image = $fileNameToStore;
            $asse->pes = $request->input('pes');
            $asse->altura = $request->input('altura');
            $asse->comentari_client = $request->input('comentari');
            $asse->save();
            return redirect()->back();

    }
    public function assAssessoriaEntrarDades(Request $request){
        $asse = Assessoria::where('id', '=', $request->route('id'))->first();

        return view('assessoria.asseAssEntrarDades', compact('asse'));
    }
    public function assAssessoriaEntrarDadesEdit(Request $request){
        $this->validate($request, [
            'dieta' => 'file|nullable|max:6000',
            'rutina' => 'nullable|max:6000'
        ]);
      //  dd($request);
        $asse = Assessoria::where('id', '=', $request->route('id'))->first();

        if($request->hasFile('dieta')){
            $filenameWithExt = $request->file('dieta')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '', $filename);
            $extension = $request->file('dieta')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('dieta')->storeAs('private/dietas/', $fileNameToStore);
            if($asse->fitxer_dieta != null){
                Storage::delete('private/dietas/'.$asse->fitxer_dieta);
            }
        } else {
            $fileNameToStore = $asse->fitxer_dieta;
        }
        $asse->fitxer_dieta = $fileNameToStore;

        if($request->hasFile('rutina')){
            $filenameWithExt = $request->file('rutina')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = str_replace(' ', '', $filename);
            $extension = $request->file('rutina')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('rutina')->storeAs('private/rutinas/', $fileNameToStore);
            if($asse->fitxer_rutina != null){
                Storage::delete('private/rutinas/'.$asse->fitxer_rutina);
            }
        } else {
            $fileNameToStore = $asse->fitxer_rutina;
        }
        $asse->fitxer_rutina = $fileNameToStore;

        $asse->comentari_assessor = $request->input('comentari');

        $asse->save();
        return redirect()->back();
    }
    public function cliHistorial(Request $request){
        if($request->route('id') != null){
        $asse = Assessoria::where('data_inici', '>=', '2014-07-10 23:59:59')
            ->whereDate('data_fi', '<=', Carbon::now()->addMonths(1))
            ->where('user_id', '=',$request->route('id'))
            ->orderBy('data_inici', 'ASC')
            ->with('user', 'assessor')->get();
           // dd($asse);
        } else {
            $asse = Assessoria::where('data_inici', '>=', '2014-07-10 23:59:59')
            ->whereDate('data_fi', '<=', Carbon::now()->addMonths(1))
            ->where('user_id', '=',auth()->user()->id)
            ->orderBy('data_inici', 'ASC')
            ->with('user', 'assessor')->get();
        }
        foreach($asse as $tar){
            $tar->dades_Tarifa = unserialize($tar->dades_Tarifa);
        }
        $asse->load('assessor.user');
        return view('assessoria.asseCliHistorial', compact('asse'));
    }

    public function cliAssessoriaRating(){

        $assessoria = Assessoria::where('data_inici', '>=', Carbon::now()->subMonth(1))
            ->whereDate('data_fi', '<=', Carbon::now()->addMonths(1))
            ->where('user_id', '=',auth()->user()->id)
            ->orderBy('data_inici', 'ASC')
            ->with('user', 'assessor')->first();
        $rating = 0;
        $ratingObj = Rating::where('assessor_id', '=', $assessoria->assessor_id )
            ->where('user_id', '=',auth()->user()->id)
            ->first();
        if (is_Object($ratingObj)){
            $rating = $ratingObj->rating;
        }
        
        /*$sum = 0;
        $i = 0;
        foreach($ratings as $rating){
            $sum += $rating->rating;
            $i++;
        }*/
       // $mitjana = round($sum / $i, 2);
        $assessor = Assessor::where('id', '=', $assessoria->assessor_id )->first();

        return view('assessoria.cliRating')->with(array( 'assessor' => $assessor, 'rating' => $rating));
    }
    public function cliAssessoriaRatingEdit(Request $request){
        $assessoria = Assessoria::where('data_inici', '>=', Carbon::now()->subMonth(1))
            ->whereDate('data_fi', '<=', Carbon::now()->addMonths(1))
            ->where('user_id', '=',auth()->user()->id)
            ->orderBy('data_inici', 'ASC')
            ->with('user', 'assessor')->first();
        $assessor = Assessor::where('id', '=', $assessoria->assessor_id )->first();
        $requestRating = array_values($request->rating)[0];
        $ratingObj = Rating::where('assessor_id', '=', $assessoria->assessor_id )
            ->where('user_id', '=',auth()->user()->id)
            ->first();

        if (is_Object($ratingObj)){
            $ratingObj->rating = $requestRating;
            $ratingObj->save();
            $notification = array(
                'message' => 'Puntuació editada',
                'alert-type' => 'success'
            );
            $allRatingAss = Rating::where('assessor_id', '=', $assessoria->assessor_id )->get();
            $average = 0;
            
            foreach($allRatingAss as $ratings){
                $average += $ratings->rating;
            }
            $assessor->avgRating = $average/count($allRatingAss);
            $assessor->save();
        //Log::debug($average/count($allRatingAss));
        } else{
            $rating = new Rating;
            $rating->rating = $requestRating;
            $rating->assessor_id = $assessoria->assessor_id;
            $rating->user_id = auth()->user()->id; 
            $rating->save();
            $notification = array(
                'message' => 'Puntuació creada',
                'alert-type' => 'success'
            );
            $allRatingAss = Rating::where('assessor_id', '=', $assessoria->assessor_id )->get();
            $average = 0;
            
            foreach($allRatingAss as $ratings){
                $average += $ratings->rating;
            }
            $assessor->avgRating = $average/count($allRatingAss);
            $assessor->save();
        }

        return response()->json([
            'notification' => $notification,
        ]);
        
    }

}
