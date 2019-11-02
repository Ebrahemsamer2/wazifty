<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['job_id'];
    
	public function users() {
		return $this->belongsToMany('App\User')->withPivot('seen', 'contact','accepted','created_at');
	}

	public function job() {
		return $this->belongsTo('App\Job');
	}
	
	public function questions() {
		return $this->hasMany('App\Question');
	}
}
