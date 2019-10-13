<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCVSTable extends Migration
{

    public function up()
    {
        Schema::create('c_v_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename');
            $table->integer('size_m');
            $table->bigInteger('user_id')->unsigned();

            // relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('c_v_s');
    }
}
