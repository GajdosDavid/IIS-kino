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
            $table->unsignedBigInteger('eventId');
            $table->unsignedBigInteger('hallId');
            $table->foreign('userId')->references('userId')->on('spectators')
                ->onDelete('cascade');
            $table->foreign('eventId')->references('eventId')->on('events')
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
        Schema::dropIfExists('reservations');
    }
}
