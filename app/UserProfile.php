<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{    
	protected $table = "userprofiles";
	
	protected $fillable = [
		'user_id',
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
