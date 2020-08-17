<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class FileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function getImage($filename) {
        $path = '../storage/app/private/progress_images/'.$filename;
        $type = "image/jpeg";
        header('Content-Type:'.$type);
        readfile($path);
        
    }
    public function getRutina($filename){
        if($filename == "null"){
            return redirect()->back();
        } else {
        $path = '../storage/app/private/rutinas/'.$filename;

        return Response::download($path, $filename);
        }
    }
    public function getDieta($filename){
        if($filename == null){
            return redirect()->back();
        } else {
        $path = '../storage/app/private/dietas/'.$filename;

        return Response::download($path, $filename);
        }
    }
 

}
