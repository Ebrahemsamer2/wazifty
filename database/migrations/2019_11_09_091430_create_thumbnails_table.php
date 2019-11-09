<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThumbnailsTable extends Migration
{
    public function up()
    {
        Schema::create('thumbnails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->integer('filesize');
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thumbnails');
    }
}
