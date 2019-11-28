<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('reservationId');
            $table->date('date');
            $table->boolean('isActive');
            $table->boolean('isPaid');
            $table->json('seats');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('performanceId');
            $table->unsignedBigInteger('hallId');
            $table->foreign('userId')->references('userId')->on('users')
                ->onDelete('cascade');
            $table->foreign('performanceId')->references('performanceId')->on('performances')
                ->onDelete('cascade');
            $table->foreign('hallId')->references('hallId')->on('halls')
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
        Schema::dropIfExists('reservations');
    }
}
