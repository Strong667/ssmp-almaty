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
            $table->dropColumn('attachment');
            $table->string('file1')->nullable()->after('description');
            $table->string('file2')->nullable()->after('file1');
            $table->string('file3')->nullable()->after('file2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_employment_infos', function (Blueprint $table) {
            $table->dropColumn(['file1', 'file2', 'file3']);
            $table->string('attachment')->nullable();
        });
    }
};
