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
        Schema::create('substations', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->unique()->comment('Номер подстанции (1-12)');
            $table->string('address')->comment('Адрес подстанции');
            $table->integer('brigades_count')->default(0)->comment('Количество бригад');
            $table->integer('doctors_count')->default(0)->comment('Количество врачей');
            $table->integer('paramedics_count')->default(0)->comment('Количество фельдшеров');
            $table->integer('junior_staff_count')->default(0)->comment('Младший персонал');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('substations');
    }
};
