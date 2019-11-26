<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventHall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_halls', function (Blueprint $table) {
            $table->bigIncrements('eventHallId');
            $table->bigInteger('hallId');
            $table->bigInteger('eventId');
            $table->foreign('hallId')->references('hallId')->on('halls')
                    ->onDelete('cascade');
            $table->foreign('eventId')->references('eventId')->on('events')
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
