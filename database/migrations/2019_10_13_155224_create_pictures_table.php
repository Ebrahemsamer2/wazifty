<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration
{
    
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->integer('filesize');
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
