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
        Schema::table('substations', function (Blueprint $table) {
            // Добавляем новые поля
            $table->string('name')->nullable()->after('id');
            $table->string('phone')->nullable()->after('address');
            
            // Изменяем тип поля address на text
            $table->text('address')->change();
            
            // Удаляем старые поля, если они не нужны
            $table->dropColumn(['number', 'brigades_count', 'doctors_count', 'paramedics_count', 'junior_staff_count']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('substations', function (Blueprint $table) {
            // Возвращаем старые поля
            $table->integer('number')->unique()->after('id');
            $table->string('address')->change();
            $table->integer('brigades_count')->default(0);
            $table->integer('doctors_count')->default(0);
            $table->integer('paramedics_count')->default(0);
            $table->integer('junior_staff_count')->default(0);
            
            // Удаляем новые поля
            $table->dropColumn(['name', 'phone']);
        });
    }
};
