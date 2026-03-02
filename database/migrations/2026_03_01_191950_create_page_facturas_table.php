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
        Schema::create('page_facturas', function (Blueprint $table) {
            $table->id();

            // Instrucciones (4 items)
            $table->string('instruccion_1')->nullable();
            $table->string('instruccion_2')->nullable();
            $table->string('instruccion_3')->nullable();
            $table->string('instruccion_4')->nullable();

            // Bloque FAQ "¿Dónde recibo mi factura?"
            $table->string('faq_title')->nullable();
            $table->text('faq_body')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_facturas');
    }
};
