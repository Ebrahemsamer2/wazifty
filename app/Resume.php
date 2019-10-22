<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillanble = [
    	'filename',
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
