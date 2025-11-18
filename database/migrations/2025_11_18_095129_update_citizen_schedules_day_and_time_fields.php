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
        // Очищаем данные перед изменением
        \DB::table('citizen_schedules')->update([
            'day' => null,
            'time' => null,
        ]);

        Schema::table('citizen_schedules', function (Blueprint $table) {
            // Изменяем day на string (день недели) - если была date, меняем на string
            if (Schema::hasColumn('citizen_schedules', 'day')) {
                $table->string('day')->nullable()->change();
            }
        });

        // Переименовываем time в time_from, если колонка существует
        if (Schema::hasColumn('citizen_schedules', 'time')) {
            \DB::statement('ALTER TABLE `citizen_schedules` CHANGE `time` `time_from` TIME NULL');
        }

        Schema::table('citizen_schedules', function (Blueprint $table) {
            // Добавляем time_to
            if (!Schema::hasColumn('citizen_schedules', 'time_to')) {
                $table->time('time_to')->nullable()->after('time_from');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('citizen_schedules', function (Blueprint $table) {
            $table->dropColumn('time_to');
            $table->renameColumn('time_from', 'time');
            $table->date('day')->nullable()->change();
        });
    }
};
