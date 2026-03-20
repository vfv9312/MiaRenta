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
        Schema::table('alquileres', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->nullable()->after('fecha_finalizada');
            $table->decimal('monto_pagado', 10, 2)->default(0)->after('total');
            $table->string('evidencia_pago')->nullable()->after('monto_pagado');
            $table->text('motivo_cancelacion')->nullable()->after('evidencia_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alquileres', function (Blueprint $table) {
            $table->dropColumn(['total', 'monto_pagado', 'evidencia_pago', 'motivo_cancelacion']);
        });
    }
};
