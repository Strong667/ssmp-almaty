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
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->comment('Год протокола');
            $table->string('title')->comment('Название протокола');
            $table->string('file_path')->comment('Путь к файлу');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('protocols');
    }
};
