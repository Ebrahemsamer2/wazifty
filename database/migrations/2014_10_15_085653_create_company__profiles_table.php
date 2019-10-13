<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('company__profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website')->nullable()->unique();
            $table->text('about')->nullable();
            
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('company__profiles');
    }
}
