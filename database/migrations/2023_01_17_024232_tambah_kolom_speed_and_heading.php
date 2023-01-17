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
        Schema::table('vehicle_trackings', function (Blueprint $table) {
            $table->string('speed')->nullable();
            $table->string('heading')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_trackings', function (Blueprint $table) {
            $table->dropColumn('speed');
            $table->dropColumn('heading');
        });
    }
};
