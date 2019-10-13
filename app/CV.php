<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CV extends Model
{
    protected $fillanble = [
    	'filename',
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
