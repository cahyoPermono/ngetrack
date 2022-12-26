<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_routes', function (Blueprint $table) {
            $table->foreign('transmitter_id')
                    ->references('id')
                    ->on('transmitters')
                    ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_routes', function (Blueprint $table) {
            $table->dropForeign(['transmitter_id']);
        });
    }
};
