<?php

namespace App;
use App\Assessor;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    public function assessors(){
        return $this->belongsToMany(Assessor::class);
    }
}
