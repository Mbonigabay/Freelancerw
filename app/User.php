<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Rateables as Rateables;
use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;

class User extends Authenticatable implements BannableContract
{
    use Rateables;
    use Notifiable;
    use Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'address',
        'username',
        'description',
        'telephone',
        'rateOfPayment',
        'areaOfExpertise',

        'sex',
        'maritalStatus',
        'educationBackground',
        'skills',
        'workExperience',
        'status',
        'verify',
        'dob',

        'last_login_at',
        'last_login_ip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function jobs(){
        return $this->belongsToMany('App\Job')->withTimestamps();
    }


    public function role(){
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

    public function photos(){
        return $this->hasMany('App\Photo');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function reports()
    {
        return $this->morphMany('App\Report', 'reporteable');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    
}
