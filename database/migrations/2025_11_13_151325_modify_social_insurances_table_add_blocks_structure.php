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
        Schema::table('social_insurances', function (Blueprint $table) {
            $table->dropColumn(['text', 'image', 'video_url']);
            $table->enum('type', ['text', 'image', 'video'])->after('id');
            $table->text('content')->nullable()->after('type');
            $table->string('image')->nullable()->after('content');
            $table->unsignedInteger('order')->default(0)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('social_insurances', function (Blueprint $table) {
            $table->dropColumn(['type', 'content', 'image', 'order']);
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
        });
    }
};
