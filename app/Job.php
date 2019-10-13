<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id',
    	'title',
        'subtitle',
    	'job_description',
        'job_type',
        'exp_from',
        'exp_to',
        'responsibility',
    	'requirements',
    	'skills',
        'salary',
    	'category_id',
        'active',
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function users() {
    	return $this->belongsToMany('App\User');
    }
}
