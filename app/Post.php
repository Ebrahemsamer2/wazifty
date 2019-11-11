<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravelista\Comments\Commentable;

class Post extends Model
{   
    use Commentable;
    
    protected $fillable = [
    	'title',
        'slug',
		'excerpt',
		'body',
		'tags',
		'user_id',
        'category_id',
    ];

    public function category() {
    	return $this->hasOne('App\PostCategory','id','category_id');
    }

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function thumbnail() {
    	return $this->hasOne('App\Thumbnail');
    }
}
