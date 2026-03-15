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
        Schema::create('colonias', function (Blueprint $table) {
            $table->id();
            $table->integer('cp');
            $table->integer('id_estado');
            $table->string('estado');
            $table->integer('id_municipio');
            $table->string('municipio');
            $table->integer('id_localidad');
            $table->string('localidad');
            $table->point('cordenadas')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->unsignedBigInteger('estatus')->nullable();
            $table->foreign('estatus')->references('id')->on('status')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colonias');
    }
};
