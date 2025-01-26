<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {//tabla para guardar imagenes del carrusel
        Schema::create('imagenes_carrusel', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();//nombre unico de la imagen
            $table->timestamps();// campo de fecha de creacion y modificación
            $table->datetime('fecha_eliminacion');// Campo para fecha y hora (YYYY-MM-DD HH:MM:SS)
            $table->enum('status', ['activo', 'inactivo'])->default('activo');//campo de estatus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_carrusel');
    }
};
