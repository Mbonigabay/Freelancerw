<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'picture',
        'body',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
