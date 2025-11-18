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
        Schema::table('substations', function (Blueprint $table) {
            $table->string('name_kk')->nullable()->after('name');
            $table->string('address_kk')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('substations', function (Blueprint $table) {
            $table->dropColumn(['name_kk', 'address_kk']);
        });
    }
};
