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
        Schema::create('vehicle_routes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vehicle_id')->unsigned();       
            $table->string('reg_no');
            $table->string('from');
            $table->string('from_long');
            $table->string('from_lat');
            $table->string('to');
            $table->string('to_long');
            $table->string('to_lat');
            $table->string('driver');
            $table->timestamps();
            $table->foreign('vehicle_id')
                    ->references('id')
                    ->on('vehicles')
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
        Schema::dropIfExists('vehicle_routes');
    }
};
