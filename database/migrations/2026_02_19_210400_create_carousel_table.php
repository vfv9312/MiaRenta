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
        Schema::create('carousel', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion')->nullable();
            $table->string('imagen');
            $table->string('boton_texto')->nullable();
            $table->string('boton_url')->nullable();
            $table->unsignedBigInteger('activo')->default(1);
            $table->string('boton_texto_two')->nullable();
            $table->string('boton_url_two')->nullable();
            $table->timestamps();
            $table->foreign('activo')->references('id')->on('status');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carousel');
    }
};
