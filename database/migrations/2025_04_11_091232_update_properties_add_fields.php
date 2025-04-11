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
            $table->string('ref')->unique()->nullable(); // se generará como R-[id] luego
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_de')->nullable();
            $table->text('description_ru')->nullable();
            $table->string('tipo')->nullable(); // casa, piso, chalet...
            $table->foreignId('zona_id')->nullable()->constrained('zonas')->nullOnDelete();
            $table->foreignId('propietario_id')->nullable()->constrained('propietarios')->nullOnDelete();
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
                'ref',
                'description_en',
                'description_fr',
                'description_de',
                'description_ru',
                'tipo'
            ]);
            $table->dropForeign(['zona_id']);
            $table->dropForeign(['propietario_id']);
            $table->dropColumn(['zona_id', 'propietario_id']);
        });
    }
};
