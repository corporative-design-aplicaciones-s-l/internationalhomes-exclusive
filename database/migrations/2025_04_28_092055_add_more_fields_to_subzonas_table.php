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
        Schema::table('subzonas', function (Blueprint $table) {
            $table->integer('habitaciones')->nullable();
            $table->integer('banos')->nullable()->after('habitaciones');
            $table->decimal('superficie', 10, 2)->nullable()->after('banos');
            $table->decimal('precio_desde', 12, 2)->nullable()->after('superficie');
            $table->string('estado', 100)->nullable()->after('precio_desde');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subzonas', function (Blueprint $table) {
            $table->dropColumn(['habitaciones', 'banos', 'superficie', 'precio_desde', 'estado']);
        });
    }
};
