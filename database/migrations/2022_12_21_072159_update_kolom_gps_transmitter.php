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
        Schema::table('transmitters', function (Blueprint $table) {
            $table->renameColumn('nama', 'imei_number');
            $table->renameColumn('type', 'gsm_number');
            $table->dropColumn('brand');
            $table->dropColumn('stock');
            $table->dropColumn('condition');
            $table->dropColumn('weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transmitters', function (Blueprint $table) {
            $table->renameColumn('imei_number', 'nama');
            $table->renameColumn('gsm_number', 'type');
            $table->string('brand');
            $table->integer('stock');
            $table->string('condition');
            $table->integer('weight');
        });
    }
};
