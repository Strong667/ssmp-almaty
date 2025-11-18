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
        Schema::table('activity_spheres', function (Blueprint $table) {
            $table->text('general_info_kk')->nullable()->after('general_info');
            $table->text('mission_kk')->nullable()->after('mission');
            $table->text('goal_kk')->nullable()->after('goal');
            $table->text('history_kk')->nullable()->after('history');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_spheres', function (Blueprint $table) {
            $table->dropColumn(['general_info_kk', 'mission_kk', 'goal_kk', 'history_kk']);
        });
    }
};
