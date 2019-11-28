<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformancesHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performances_halls', function (Blueprint $table) {
            $table->bigIncrements('performanceHallId');
            $table->unsignedBigInteger('hallId');
            $table->unsignedBigInteger('performanceId');
            $table->foreign('hallId')->references('hallId')->on('halls')
                ->onDelete('cascade');
            $table->foreign('performanceId')->references('performanceId')->on('performances')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('performances_halls');
    }
}
