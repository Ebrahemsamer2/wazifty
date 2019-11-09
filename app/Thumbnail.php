<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thumbnail extends Model
{
	protected $fillable = ['filename','filesize','post_id'];

}
