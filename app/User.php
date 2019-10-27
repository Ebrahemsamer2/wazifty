<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        return $this->belongsToMany('App\Application');
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
}
