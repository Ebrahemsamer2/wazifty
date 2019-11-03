<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'admin',
        'emp_type',
    ];
    protected $hidden = [
        'password', 'remember_token','pivot',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function resume() {
        return $this->hasOne('App\Resume');
    }

    public function applications() {
        return $this->belongsToMany('App\Application')->withPivot('seen', 'contact','accepted','created_at');
    }

    public function saved_jobs() {
        return $this->belongsToMany('App\Job', 'user_saved_jobs');
    }
    
    public function answers() {
        return $this->hasMany('App\Answer');
    }
    
    public function jobs() {
        return $this->hasMany('App\Job');
    }

    public function userprofile() {
        return $this->hasOne('App\UserProfile');
    }

    public function companyprofile() {
        return $this->hasOne('App\CompanyProfile');
    }

    public function picture()
    {
        return $this->hasOne('App\Picture');
    }

    // Functions
    public function isOwner() {
        return $this->email == 'Soltan_Algaram41@yahoo.com';
    }

    public function isAdmin() {
        return $this->admin == 1;
    }

    // check if a specific job is saved or not 
    public function isSaved($job_id) {
        return $this->saved_jobs()->where('job_id', $job_id)->first();
    }
    
}
