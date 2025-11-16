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
        Schema::create('director_questions', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // имя пользователя
            $table->string('email');                   // email пользователя
            $table->text('question');                  // вопрос
            $table->text('answer')->nullable();        // ответ (заполняется админом)
            $table->boolean('published')->default(false); // опубликовано ли
            $table->boolean('notify_email')->default(false); // уведомление на email
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('director_questions');
    }
};
