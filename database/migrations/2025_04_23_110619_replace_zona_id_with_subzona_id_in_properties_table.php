<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['zona_id']);
            $table->dropColumn('zona_id');
            $table->unsignedBigInteger('subzona_id')->nullable()->after('tipo');
            $table->foreign('subzona_id')->references('id')->on('subzonas')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['subzona_id']);
            $table->dropColumn('subzona_id');
            $table->unsignedBigInteger('zona_id')->nullable()->after('tipo');
            $table->foreign('zona_id')->references('id')->on('zonas')->nullOnDelete();
        });
    }

};
