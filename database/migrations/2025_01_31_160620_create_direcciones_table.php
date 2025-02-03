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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('colonias_id');
            $table->unsignedBigInteger('status_id');
            $table->string('calle');
            $table->string('entre_calles');
            $table->text('referencia');
            $table->point('cordenadas')->nullable();
            $table->integer('cp')->nullable();
            $table->timestamps();
            $table->foreign('colonias_id')->references('id')->on('colonias');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
