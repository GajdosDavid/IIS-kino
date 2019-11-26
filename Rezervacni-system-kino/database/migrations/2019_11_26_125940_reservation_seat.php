<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReservationSeat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_seats', function (Blueprint $table) {
            $table->unsignedBigInteger('resID');
            $table->unsignedBigInteger('seaID');
            $table->foreign('resID')->references('reservationId')->on('reservations')
                    ->onDelete('cascade');
            $table->foreign('seaID')->references('seatId')->on('seats')
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
        //
    }
}
