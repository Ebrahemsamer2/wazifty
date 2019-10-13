<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
    	'title',
    ];

    public function answer() {
    	return $this->hasOne('App\Answer');
    }

    public function application() {
    	return $this->belongsTo('App\Application');
    }
}
