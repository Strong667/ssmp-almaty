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
        Schema::table('mission_of_emergency_services', function (Blueprint $table) {
            // Добавляем поле для казахского изображения
            $table->string('image_kk')->nullable()->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mission_of_emergency_services', function (Blueprint $table) {
            // Удаляем поле для казахского изображения
            $table->dropColumn('image_kk');
        });
    }
};
