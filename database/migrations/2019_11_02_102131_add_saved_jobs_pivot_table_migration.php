<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSavedJobsPivotTableMigration extends Migration
{

    public function up()
    {
        Schema::create('user_saved_jobs', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('job_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs');->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::dropIfExists('user_saved_jobs');
    }
}
