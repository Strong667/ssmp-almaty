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
        Schema::create('activity_spheres', function (Blueprint $table) {
            $table->id();
            $table->text('general_info')->nullable()->comment('Общая информация об организации');
            $table->text('mission')->nullable()->comment('Миссия организации');
            $table->text('goal')->nullable()->comment('Цель организации');
            $table->text('history')->nullable()->comment('История ССМП');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_spheres');
    }
};
