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
    Schema::table('properties', function (Blueprint $table) {
        $table->string('location')->nullable()->change();
        $table->decimal('price', 10, 2)->nullable()->change();
        $table->string('tipo')->nullable()->change();
        $table->text('description')->nullable()->change();
        $table->text('description_en')->nullable()->change();
        $table->text('description_fr')->nullable()->change();
        $table->text('description_de')->nullable()->change();
        $table->text('description_ru')->nullable()->change();
        $table->string('thumbnail')->nullable();
        $table->string('ref')->nullable()->change();
        $table->foreignId('zona_id')->nullable()->change();
        $table->foreignId('propietario_id')->nullable()->change();
    });
}

public function down()
{
    Schema::table('properties', function (Blueprint $table) {
        $table->string('location')->nullable(false)->change();
        $table->decimal('price', 10, 2)->nullable(false)->change();
        $table->string('tipo')->nullable(false)->change();
        $table->text('description')->nullable(false)->change();
        $table->text('description_en')->nullable(false)->change();
        $table->text('description_fr')->nullable(false)->change();
        $table->text('description_de')->nullable(false)->change();
        $table->text('description_ru')->nullable(false)->change();
        $table->dropColumn('thumbnail');
        $table->string('ref')->nullable(false)->change();
        $table->foreignId('zona_id')->nullable(false)->change();
        $table->foreignId('propietario_id')->nullable(false)->change();
    });
}

};
