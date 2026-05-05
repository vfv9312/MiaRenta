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
        Schema::create('facturas_solicitadas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ticket');
            $table->string('rfc');
            $table->string('razon_social');
            $table->string('regimen');
            $table->string('uso_cfdi');
            $table->string('cp');
            $table->string('email');
            $table->string('constancia_path')->nullable();
            $table->string('nota_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas_solicitadas');
    }
};
