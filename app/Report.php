<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'id',
        'reporter',
        'reported',
        'reporteable_id',
        'reporteable_type',
        'title',
        'body',
    ];

    public function reportable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne('\App\User', 'id', 'user_id');
    }
}
