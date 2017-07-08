<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActiveToTriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trios', function (Blueprint $table) {
            $table->boolean('active')->default(0);
            $table->text('note')->nullable();
        });

        Schema::table('trio_changes', function (Blueprint $table) {
            $table->text('before')->nullable()->change();
            $table->text('after')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trios', function (Blueprint $table) {
            $table->dropColumn(['active', 'note']);
        });
    }
}
