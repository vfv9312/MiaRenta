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
        Schema::table('facturas_solicitadas', function (Blueprint $table) {
            $table->string('factura_path')->nullable()->after('nota_path');
            $table->enum('estatus', ['pendiente', 'enviada'])->default('pendiente')->after('factura_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facturas_solicitadas', function (Blueprint $table) {
            $table->dropColumn(['factura_path', 'estatus']);
        });
    }
};
