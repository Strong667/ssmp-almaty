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
        Schema::table('procurement_plans', function (Blueprint $table) {
            $table->string('title')->after('id')->comment('Полный текст плана закупок');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('procurement_plans', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
};
