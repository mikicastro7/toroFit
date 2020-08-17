<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessoria extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    public function assessor()
    {
        return $this->belongsTo('App\Assessor', 'assessor_id');
    }
}