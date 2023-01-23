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
        Schema::create('non_route_trackings', function (Blueprint $table) {
            $table->id();
            $table->string('imei');
            $table->string('team_id')->nullable();
            $table->string('long');
            $table->string('lat');
            $table->string('speed')->nullable();
            $table->string('heading')->nullable();
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
        Schema::dropIfExists('non_route_trackings');
    }
};
