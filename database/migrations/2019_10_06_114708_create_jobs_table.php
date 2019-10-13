<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('subtitle')->nullable();
            $table->text('job_description');
            $table->string('job_type');
            $table->integer('exp_from');
            $table->integer('exp_to');
            $table->text('responsibility');
            $table->text('requirements');
            $table->text('skills');
            $table->text('salary');
            $table->integer('active')->default(1);
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();

            // relationships
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
