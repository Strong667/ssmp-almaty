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
        Schema::table('citizen_schedules', function (Blueprint $table) {
            // Сначала делаем колонки nullable
            $table->string('day')->nullable()->change();
            $table->string('time')->nullable()->change();
        });

        // Очищаем старые данные
        \DB::table('citizen_schedules')->update([
            'day' => null,
            'time' => null,
        ]);

        Schema::table('citizen_schedules', function (Blueprint $table) {
            // Добавляем новое поле только если его еще нет
            if (!Schema::hasColumn('citizen_schedules', 'position_kk')) {
                $table->string('position_kk')->nullable()->after('position');
            }
            // Изменяем тип колонок на date и time
            $table->date('day')->nullable()->change();
            $table->time('time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizen_schedules', function (Blueprint $table) {
            $table->string('day')->nullable()->change();
            $table->string('time')->nullable()->change();
            $table->dropColumn('position_kk');
        });
    }
};
