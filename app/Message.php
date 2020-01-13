<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable= [
        'title',
        'user_from',
        'user_to',
        'body',
        'status',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_from');
    }
}
