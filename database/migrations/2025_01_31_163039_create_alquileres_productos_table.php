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
        Schema::create('alquileres_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alquiler_id');
            $table->unsignedBigInteger('Catalogo_precio_id');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('alquiler_id')->references('id')->on('alquileres');
            $table->foreign('Catalogo_precio_id')->references('id')->on('catalago_precios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquileres_productos');
    }
};
