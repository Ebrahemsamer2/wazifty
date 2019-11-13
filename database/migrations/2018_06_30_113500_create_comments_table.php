<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{

    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('comment');
            $table->bigInteger('user_id');
            $table->bigInteger('post_id');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
