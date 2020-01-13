<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name',
        'jobBudget',
        'description',
        'skills',
        'status',
        'user_id',
        'location',
        'deadline',
        'bidDeadline',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'job_user', 'job_id',
            'user_id')->withPivot('status')->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
