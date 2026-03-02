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
        Schema::create('page_politicas', function (Blueprint $table) {
            $table->id();

            // Sección 1: Métodos y Políticas de Pago
            $table->text('pagos_intro')->nullable();
            $table->string('pagos_item_1')->nullable();
            $table->string('pagos_item_2')->nullable();
            $table->string('pagos_item_3')->nullable();
            $table->string('pagos_item_4')->nullable();

            // Sección 2: Horarios y Reservaciones
            $table->text('reservaciones_intro')->nullable();
            $table->string('reservacion_estandar_titulo')->nullable();
            $table->string('reservacion_estandar_texto')->nullable();
            $table->string('reservacion_urgente_titulo')->nullable();
            $table->string('reservacion_urgente_texto')->nullable();

            // Sección 3: Entregas y Recolección
            $table->text('entregas_texto')->nullable();

            // Sección 4: Cancelaciones
            $table->text('cancelaciones_texto')->nullable();

            // Sección 5: Cuidado del Mobiliario
            $table->text('cuidado_texto')->nullable();

            // Footer note
            $table->string('footer_nota')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_politicas');
    }
};
