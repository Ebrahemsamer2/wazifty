<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    
	public function questions() {
		return $this->hasMany('App\Question');
	}
}
