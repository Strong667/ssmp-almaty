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
        Schema::table('paid_services', function (Blueprint $table) {
            $table->string('title_kk')->nullable()->after('title');
            $table->text('description_kk')->nullable()->after('description');
            $table->string('file_kk')->nullable()->after('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paid_services', function (Blueprint $table) {
            $table->dropColumn(['title_kk', 'description_kk', 'file_kk']);
        });
    }
};
