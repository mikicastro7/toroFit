<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
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
