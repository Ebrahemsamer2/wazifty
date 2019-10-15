<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{	
	protected $fillable = [
		'filename',
		'filesize',
		'user_id',
	];
	
	public function user() {
		return $this->belongsTo('App\User');
	}
}
