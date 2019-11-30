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
            $table->unsignedBigInteger('hall_id');
            $table->unsignedBigInteger('performance_id');
            $table->foreign('hall_id')->references('id')->on('halls')
                ->onDelete('cascade');
            $table->foreign('performance_id')->references('id')->on('performances')
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
