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
        Schema::create('procurement_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->unique()->comment('Год плана закупок');
            $table->string('file_path')->comment('Путь к файлу Excel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('procurement_plans');
    }
};
