<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceHallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_hall', function (Blueprint $table) {
            $table->unsignedBigInteger('hallId');
            $table->unsignedBigInteger('performanceId');
            $table->foreign('hallId')->references('id')->on('halls')
                ->onDelete('cascade');
            $table->foreign('performanceId')->references('id')->on('performances')
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
        Schema::dropIfExists('performance_hall');
    }
}
