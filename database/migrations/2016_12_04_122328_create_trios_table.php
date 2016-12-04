<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sentence1');
            $table->string('sentence2');
            $table->string('sentence3');
            $table->text('explanation1');
            $table->text('explanation2');
            $table->text('explanation3');
            $table->string('answer');
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
        Schema::dropIfExists('trios');
    }
}
