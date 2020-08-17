<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Assessor;

class Tarifa extends Model
{
    public function assessors(){
        return $this->belongsTo('App\Assessor', 'assessor_id');
    }
}
