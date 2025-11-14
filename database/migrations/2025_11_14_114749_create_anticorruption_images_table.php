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
        Schema::create('anticorruption_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anticorruption_id')->constrained('anticorruptions')->onDelete('cascade');
            $table->string('image');
            $table->boolean('is_header')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anticorruption_images');
    }
};
