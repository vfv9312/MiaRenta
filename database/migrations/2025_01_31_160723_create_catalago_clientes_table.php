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
        Schema::create('catalago_clientes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direccion_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('status_id');
            $table->tinyInteger('prioridad');
            $table->timestamps();
            $table->foreign('direccion_id')->references('id')->on('direcciones');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalago_clientes');
    }
};
