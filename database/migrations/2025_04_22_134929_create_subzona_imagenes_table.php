<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubzonaImagenesTable extends Migration
{
    public function up(): void
    {
        Schema::create('subzona_imagenes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subzona_id')->constrained()->onDelete('cascade');
            $table->string('path'); // Ruta de la imagen en storage
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subzona_imagenes');
    }
}
