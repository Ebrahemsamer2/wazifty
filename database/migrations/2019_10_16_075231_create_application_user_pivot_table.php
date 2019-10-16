<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicationUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('application_user', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('application_id')->unsigned();
            $table->integer('seen')->default(0);
            $table->integer('contact')->default(0);
            $table->integer('accepted')->default(0);

            // relationships
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_user');
    }
}
