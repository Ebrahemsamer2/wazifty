<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
    	'title',
    	'application_id',
    ];

    public function answers() {
    	return $this->hasMany('App\Answer');
    }

    public function application() {
    	return $this->belongsTo('App\Application');
    }
}
