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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('catalogo_tipo_id');
            $table->unsignedBigInteger('color_id');
            $table->string('nombre');
            $table->integer('cantidad');
            $table->text('descripcion');
            $table->tinyInteger('prioridad');
            $table->timestamps();
            $table->foreign('catalogo_tipo_id')->references('id')->on('catalago_tipos');
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('color_id')->references('id')->on('colores');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
