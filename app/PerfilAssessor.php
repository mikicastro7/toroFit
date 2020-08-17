<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilAssessor extends Model
{
    public function assessors(){
        return $this->belongsTo(Assessor::class);
    }
}
