<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (Schema::hasColumn('properties', 'propietario_id')) {
                $table->dropForeign(['propietario_id']);
                $table->dropColumn('propietario_id');
            }
            $table->foreignId('subzona_id')->nullable()->constrained('subzonas')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('propietario_id')->nullable();
            $table->foreign('propietario_id')->references('id')->on('users')->nullOnDelete();
            $table->dropForeign(['subzona_id']);
            $table->dropColumn('subzona_id');
        });
    }
};
