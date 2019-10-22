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
    
    // jobs you posted as a employer or admin
    public function jobs() {
        return $this->hasMany('App\Job');
    }

    public function user__profile() {
        return $this->hasMany('App\User_Profile');
    }

    public function company__profile() {
        return $this->hasMany('App\Company_Profile');
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
