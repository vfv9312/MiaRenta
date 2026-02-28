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
        Schema::create('page_catalags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->string('icon');
            $table->string('title_button_one');
            $table->string('text_button_one');
            $table->string('button_url_one');
            $table->unsignedBigInteger('status_one')->default(true);
            $table->string('icon_two');
            $table->string('title_button_two');
            $table->string('text_button_two');
            $table->string('button_url_two');
            $table->unsignedBigInteger('status_two')->default(true);
            $table->string('icon_three');
            $table->string('title_button_three');
            $table->string('text_button_three');
            $table->string('button_url_three');
            $table->unsignedBigInteger('status_three')->default(true);
            $table->string('icon_four');
            $table->string('title_button_four');
            $table->string('text_button_four');
            $table->string('button_url_four');
            $table->unsignedBigInteger('status_four')->default(true);
            $table->foreign('status_one')->references('id')->on('status');
            $table->foreign('status_two')->references('id')->on('status');
            $table->foreign('status_three')->references('id')->on('status');
            $table->foreign('status_four')->references('id')->on('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_catalags');
    }
};
