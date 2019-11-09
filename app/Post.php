<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    	'title',
    	'slug',
		'excerpt',
		'body',
		'tags',
		'category_id',
    ];

    public function category() {
    	return $this->hasOne('App\PostCategory','category_id');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function thumbnail() {
    	return $this->hasOne('App\Thumbnail');
    }
}
