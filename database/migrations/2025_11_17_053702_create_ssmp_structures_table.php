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
        Schema::create('ssmp_structures', function (Blueprint $table) {
            $table->id();
            $table->integer('substation_number')->unique();
            $table->string('address');
            $table->integer('brigades_count')->default(0);
            $table->integer('doctors_count')->default(0);
            $table->integer('paramedics_count')->default(0);
            $table->integer('junior_staff_count')->default(0);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssmp_structures');
    }
};
