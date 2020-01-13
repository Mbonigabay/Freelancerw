<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('reporter')->unsigned();
            $table->foreign('reporter')->references('id')->on('users');

            $table->integer('reported')->unsigned();
            $table->foreign('reported')->references('id')->on('users');

            $table->integer('reporteable_id')->unsigned();
            $table->string('reporteable_type');
            $table->string('title');
            $table->longtext('body');
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
        Schema::dropIfExists('reports');
    }
}
