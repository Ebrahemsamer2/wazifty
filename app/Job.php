<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'user_id',
    	'title',
        'subtitle',
        'slug',
    	'job_description',
        'job_type',
        'exp_from',
        'exp_to',
        'responsibility',
    	'requirements',
    	'skills',
        'salary',
    	'category_id',
        'work_place',
        'active',
    ];

    
    public function application() {
        return $this->hasOne('App\Application');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
    	return $this->belongsTo('App\Category');
    }

}
