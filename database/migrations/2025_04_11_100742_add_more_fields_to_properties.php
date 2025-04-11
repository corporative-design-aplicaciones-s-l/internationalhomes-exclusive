<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('tiene_solar')->default(false);
            $table->integer('metros_solar')->nullable();
            $table->boolean('tiene_patio')->default(false);
            $table->boolean('tiene_piscina')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn([
                'tiene_solar',
                'metros_solar',
                'tiene_patio',
                'tiene_piscina'
            ]);
        });
    }
};
