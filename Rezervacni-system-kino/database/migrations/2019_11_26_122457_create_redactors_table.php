<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedactorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redactors', function (Blueprint $table) {
            $table->bigIncrements('redactorId');
            $table->string('name');
            $table->string('middleName');
            $table->string('surname');
            $table->string('phone');
            $table->string('mail');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('redactors');
    }
}
