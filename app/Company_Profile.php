<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_Profile extends Model
{
    protected $fillable = [
    	'website',
    	'about',
    ];
    
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
