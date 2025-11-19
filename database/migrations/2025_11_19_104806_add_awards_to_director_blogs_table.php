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
            $table->text('awards')->nullable()->after('career_kk');
            $table->text('awards_kk')->nullable()->after('awards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('director_blogs', function (Blueprint $table) {
            $table->dropColumn(['awards', 'awards_kk']);
        });
    }
};
