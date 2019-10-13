<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
    	'the_answer',
    ];

    public function question() {
    	return $this->belongsTo('App\Question');
    }

    public function users() {
    	return $this->belongsTo('App\User');
    }

}
