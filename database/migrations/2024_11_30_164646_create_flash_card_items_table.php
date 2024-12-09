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
        Schema::create('flash_card_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('flash_card_packages')->cascadeOnDelete();
            $table->string('question');
            $table->string('answer');
            $table->string('transcription')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flash_card_items');
    }
};
