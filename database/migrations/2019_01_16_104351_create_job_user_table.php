<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->default("standby");

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users'); 

            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs'); 

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
        Schema::dropIfExists('job_user');
    }
}
