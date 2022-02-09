<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public function departments(){
        return $this->belongsTo('App\Departments', 'department_id');
    }
}
