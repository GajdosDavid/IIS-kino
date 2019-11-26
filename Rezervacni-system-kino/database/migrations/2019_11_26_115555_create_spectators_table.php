<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpectatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spectators', function (Blueprint $table) {
            $table->bigIncrements('userId');
            $table->string('name');
            $table->string('middleName');
            $table->string('surname');
            $table->string('phone');
            $table->string('mail');
            //$table->integer('adminId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spectators');
    }
}
