<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    public function complaints(){
        return $this->belongsTo('App\Complaints', 'complaint_id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
