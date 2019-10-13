<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone')->unique()->nullable();
            $table->string('github')->nullable()->unique();
            $table->string('portfolio')->nullable()->unique();
            $table->text('skills')->nullable();
            $table->text('summary')->nullable();
            $table->string('job_title')->nullable();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user__profiles');
    }
}
