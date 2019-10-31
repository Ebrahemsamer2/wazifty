<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTable extends Migration
{

    public function up()
    {
        Schema::create('companyprofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone')->nullable()->unique();
            $table->string('website')->nullable()->unique();
            $table->string('address')->nullable();
            $table->text('about')->nullable();
                
            $table->string('github')->nullable()->unique();
            $table->string('portfolio')->nullable()->unique();
            $table->string('linkedin')->nullable()->unique();
            $table->string('facebook')->nullable()->unique();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companyprofiles');
    }
}
