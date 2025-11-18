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
            $table->string('title_kk')->nullable()->after('title');
            $table->text('description_kk')->nullable()->after('description');
            $table->string('file1_name_kk')->nullable()->after('file1_name');
            $table->string('file1_kk')->nullable()->after('file1');
            $table->string('file2_name_kk')->nullable()->after('file2_name');
            $table->string('file2_kk')->nullable()->after('file2');
            $table->string('file3_name_kk')->nullable()->after('file3_name');
            $table->string('file3_kk')->nullable()->after('file3');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_employment_infos', function (Blueprint $table) {
            $table->dropColumn([
                'title_kk',
                'description_kk',
                'file1_name_kk',
                'file1_kk',
                'file2_name_kk',
                'file2_kk',
                'file3_name_kk',
                'file3_kk',
            ]);
        });
    }
};
