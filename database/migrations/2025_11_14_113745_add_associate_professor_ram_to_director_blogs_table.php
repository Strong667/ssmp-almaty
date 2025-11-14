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
            $table->text('associate_professor_ram')->nullable()->after('career');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('director_blogs', function (Blueprint $table) {
            $table->dropColumn('associate_professor_ram');
        });
    }
};
