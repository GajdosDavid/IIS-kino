<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances', function (Blueprint $table) {
            $table->bigIncrements('performanceId');
            $table->time('beginning');
            $table->time('end');
            $table->date('date');
            $table->integer('price');
            $table->string('type');
            $table->string('eventName');
            $table->string('description');
            $table->string('genre');
            $table->binary('image');
            $table->string('performer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('performances');
    }
}
