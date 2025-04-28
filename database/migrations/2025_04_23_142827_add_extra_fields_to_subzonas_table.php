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
        Schema::table('subzonas', function (Blueprint $table) {
            $table->string('estado')->nullable();
            $table->string('fecha_entrega')->nullable()->after('estado'); // o una fecha real si prefieres Date
            $table->text('ventajas')->nullable()->after('fecha_entrega'); // beneficios tipo lista
            $table->text('equipamiento')->nullable()->after('ventajas');  // ej: cocina equipada, A/C, etc.
            $table->string('plano')->nullable()->after('equipamiento');   // ruta a imagen o plano PDF
            $table->string('pdf_info_comercial')->nullable()->after('plano'); // PDF descargable
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
            //
        });
    }
};
