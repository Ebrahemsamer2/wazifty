<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Profile extends Model
{    
	protected $fillable = [
		'job_title',
		'phone',
		'portfolio',
		'github',
		'summary',
		'skills',
	];
	
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
