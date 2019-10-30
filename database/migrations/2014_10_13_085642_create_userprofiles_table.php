<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_title')->nullable();
            $table->text('summary')->nullable();
            $table->text('skills')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('github')->nullable()->unique();
            $table->string('portfolio')->nullable()->unique();
            $table->string('linkedin')->nullable()->unique();
            $table->string('website')->nullable()->unique();
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('userprofiles');
    }
}
