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
        Schema::create('combinacion_producto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combinacion_id');
            $table->unsignedBigInteger('producto_id');
            $table->timestamps();
            $table->foreign('combinacion_id')->references('id')->on('combinaciones')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combinacion_producto');
    }
};
