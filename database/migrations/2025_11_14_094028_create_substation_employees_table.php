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
        Schema::create('substation_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('substation_id')->constrained('substations')->onDelete('cascade'); // Подстанция
            $table->string('photo')->nullable(); // Фото
            $table->string('full_name'); // ФИО
            $table->string('position'); // Должность
            $table->text('description')->nullable(); // Описание
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('substation_employees');
    }
};
