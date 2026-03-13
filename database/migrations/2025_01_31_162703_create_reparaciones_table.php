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
        Schema::create('reparaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');                         // cantidad enviada a reparar
            $table->integer('cantidad_reparada')->nullable();    // cuántos se lograron reparar
            $table->date('fecha');                               // fecha de envío a reparación
            $table->date('fecha_reparacion')->nullable();        // fecha en que se reparó
            $table->string('descripcion');
            $table->decimal('precio', 10, 2)->nullable();       // costo de la reparación (se llena al reparar)
            $table->timestamps();
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reparaciones');
    }
};
