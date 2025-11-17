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
        Schema::table('medical_employment_infos', function (Blueprint $table) {
            $table->string('file1_name')->nullable()->after('file3');
            $table->string('file2_name')->nullable()->after('file1_name');
            $table->string('file3_name')->nullable()->after('file2_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_employment_infos', function (Blueprint $table) {
            $table->dropColumn(['file1_name', 'file2_name', 'file3_name']);
        });
    }
};
