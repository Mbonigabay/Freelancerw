<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobUser extends Model
{
    protected $fillable= [
            'status',
    		'user_id',
    		'job_id',
    ];

    public function user(){
        return $this->belongTo('App\User');
    }

    public function job(){
        return $this->belongTo('App\Models\Job');
    }

}
