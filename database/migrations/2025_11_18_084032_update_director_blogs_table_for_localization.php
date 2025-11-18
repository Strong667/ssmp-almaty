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
        Schema::table('director_blogs', function (Blueprint $table) {
            // Удаляем поле Ассоциированный профессор РАМ
            $table->dropColumn('associate_professor_ram');
            
            // Добавляем казахские версии полей
            $table->text('personal_info_kk')->nullable()->after('personal_info');
            $table->text('education_kk')->nullable()->after('education');
            $table->text('career_kk')->nullable()->after('career');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('director_blogs', function (Blueprint $table) {
            // Возвращаем поле Ассоциированный профессор РАМ
            $table->text('associate_professor_ram')->nullable()->after('career');
            
            // Удаляем казахские версии полей
            $table->dropColumn(['personal_info_kk', 'education_kk', 'career_kk']);
        });
    }
};
