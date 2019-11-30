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
            $table->bigIncrements('id');
            $table->boolean('isPaid')->default(false);
            $table->string('seats');
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('performanceId');
            $table->unsignedBigInteger('hallId');
            $table->timestamps();
            $table->foreign('userId')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('performanceId')->references('id')->on('performances')
                ->onDelete('cascade');
            $table->foreign('hallId')->references('id')->on('halls')
                ->onDelete('cascade');
            $table->string('firstName')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->nullable();
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
