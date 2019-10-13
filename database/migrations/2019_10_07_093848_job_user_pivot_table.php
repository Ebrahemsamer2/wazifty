<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JobUserPivotTable extends Migration
{
    
    public function up()
    {
        Schema::create('job_user', function (Blueprint $table) {
            $table->bigInteger('job_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_user');
    }
}
