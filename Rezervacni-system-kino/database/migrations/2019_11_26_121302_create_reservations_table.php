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
            $table->boolean('is_paid')->default(false);
            $table->string('seats');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('performance_id');
            $table->unsignedBigInteger('hall_id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('performance_id')->references('id')->on('performances')
                ->onDelete('cascade');
            $table->foreign('hall_id')->references('id')->on('halls')
                ->onDelete('cascade');
            $table->string('first_name')->nullable();
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
