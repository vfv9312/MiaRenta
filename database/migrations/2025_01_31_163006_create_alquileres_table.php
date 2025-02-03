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
        Schema::create('alquileres', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('direcciónes_clientes_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('metodo_pago_id');
            $table->string('recibe');
            $table->string('entrega');
            $table->dateTime('fecha_solicitada')->nullable();
            $table->dateTime('fecha_entrega')->nullable();
            $table->dateTime('fecha_recepcion')->nullable();
            $table->dateTime('fecha_finalizada')->nullable();
            $table->timestamps();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('direcciónes_clientes_id')->references('id')->on('catalago_clientes');
            $table->foreign('metodo_pago_id')->references('id')->on('metodos_pagos');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alquileres');
    }
};
