<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replies extends Model
{
    public function users(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function complaints(){
        return $this->belongsTo('App\Complaints', 'complaint_id');
    }
}
