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
    {
        Schema::create('contactos_data_tipos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contacto_tipo_id');
            $table->string('nombre');
            $table->string('imagen')->nullable();
            $table->string('ruta')->nullable();
            $table->timestamps();
            $table->foreign('contacto_tipo_id')->references('id')->on('tipos_contacto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos_data_tipos');
    }
};
