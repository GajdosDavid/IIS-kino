<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('userId');
            $table->string('name');
            $table->string('middleName');
            $table->string('surname');
            $table->string('phone');
            $table->string('mail');
            $table->string('password');
            /*
             * 0 : spectator
             * 1 : cashier
             * 2 : redactor
             * 3 : admin
             */
            $table->integer('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
