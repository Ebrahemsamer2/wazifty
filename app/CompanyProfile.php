<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
	protected $table = "companyprofiles"; 
	
    protected $fillable = [
    	'website',
    	'address',
    	'about',
    ];
    
    public function user() {
    	return $this->hasOne('App\User');
    }
}
