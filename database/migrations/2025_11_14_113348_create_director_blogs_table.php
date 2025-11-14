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
        Schema::create('director_blogs', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('full_name');
            $table->text('personal_info')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('education')->nullable();
            $table->text('career')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director_blogs');
    }
};
