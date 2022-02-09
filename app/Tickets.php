<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    public function users(){
        return $this->belongsTo('App\User', 'assigned_to');
    }

    public function submittedBy(){
        return $this->belongsTo('App\User', 'user_id');
    }


    public function departments(){
        return $this->belongsTo('App\Departments', 'department_id');
    }


}
