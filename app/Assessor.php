<?php

namespace App;
use App\Etiqueta;

use Illuminate\Database\Eloquent\Model;

class Assessor extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function etiquetas(){
        return $this->belongsToMany(Etiqueta::class);
    }
    public function tarifas(){
        return $this->hasMany(Tarifa::class);
    }
    public function perfilAssessors(){
        return $this->hasOne(PerfilAssessor::class);
    }
    public function assessorias(){
        return $this->hasMany(Assessoria::class);
    }

}
