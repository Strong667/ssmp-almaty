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
        Schema::table('anticorruptions', function (Blueprint $table) {
            // Добавляем казахские версии полей
            $table->string('title_kk')->nullable()->after('title');
            $table->text('description_kk')->nullable()->after('description');
            $table->text('service_tasks_kk')->nullable()->after('service_tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anticorruptions', function (Blueprint $table) {
            // Удаляем казахские версии полей
            $table->dropColumn(['title_kk', 'description_kk', 'service_tasks_kk']);
        });
    }
};
