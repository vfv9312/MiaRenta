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
        Schema::create('page_nosotros', function (Blueprint $table) {
            $table->id();
            $table->string('banner_title')->nullable();
            $table->text('banner_subtitle')->nullable();

            $table->string('history_title')->nullable();
            $table->text('history_text')->nullable();
            $table->string('history_image')->nullable();
            $table->string('history_stat_number')->nullable();
            $table->string('history_stat_text')->nullable();

            $table->text('mission_text')->nullable();
            $table->text('vision_text')->nullable();
            $table->json('values_list')->nullable(); // Store values as JSON array or text

            $table->string('cta_title')->nullable();
            $table->string('cta_button_text')->nullable();
            $table->string('cta_button_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_nosotros');
    }
};
