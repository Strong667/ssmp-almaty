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
        Schema::table('ethical_codes', function (Blueprint $table) {
            $table->string('title_kk')->nullable()->after('title');
            $table->string('pdf_path_kk')->nullable()->after('pdf_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ethical_codes', function (Blueprint $table) {
            $table->dropColumn(['title_kk', 'pdf_path_kk']);
        });
    }
};
