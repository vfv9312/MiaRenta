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
        Schema::table('catalogo_imagines', function (Blueprint $table) {
            // Make producto_id nullable (images can belong to a combination instead)
            $table->unsignedBigInteger('producto_id')->nullable()->change();

            // Add combinacion_id (nullable)
            $table->unsignedBigInteger('combinacion_id')->nullable()->after('producto_id');
            $table->foreign('combinacion_id')->references('id')->on('combinaciones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('catalogo_imagines', function (Blueprint $table) {
            $table->dropForeign(['combinacion_id']);
            $table->dropColumn('combinacion_id');
        });
    }
};
