<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTrioAttemptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trio_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trio_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('attempts')->unsigned();
            $table->boolean('solved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_trio_attempts');
    }
}
