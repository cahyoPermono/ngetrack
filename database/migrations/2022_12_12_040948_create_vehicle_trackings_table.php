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
        Schema::create('vehicle_trackings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_route_id')->unsigned();
            $table->string('long');
            $table->string('lat');
            $table->string('send_time');
            $table->timestamps();
            $table->foreign('vehicle_route_id')
                    ->references('id')
                    ->on('vehicle_routes')
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
        Schema::dropIfExists('vehicle_trackings');
    }
};
