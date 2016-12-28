<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrioChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trio_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trio_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('field_name');
            $table->text('before');
            $table->text('after');
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
        Schema::dropIfExists('trio_changes');
    }
}
