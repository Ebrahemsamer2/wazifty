<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = ['name'];

    public function post() {
		return $this->belongsTo('App\Post');
	}
}
