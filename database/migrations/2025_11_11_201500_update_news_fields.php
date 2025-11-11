<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table): void {
            $table->text('description')->nullable()->after('slug');
            $table->string('video_url')->nullable()->after('description');
        });

        DB::table('news')
            ->select('id', 'content')
            ->orderBy('id')
            ->chunkById(100, function ($rows): void {
                foreach ($rows as $row) {
                    DB::table('news')
                        ->where('id', $row->id)
                        ->update(['description' => $row->content]);
                }
            });

        Schema::table('news', function (Blueprint $table): void {
            $table->dropColumn('content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table): void {
            $table->text('content')->nullable()->after('slug');
        });

        DB::table('news')
            ->select('id', 'description')
            ->orderBy('id')
            ->chunkById(100, function ($rows): void {
                foreach ($rows as $row) {
                    DB::table('news')
                        ->where('id', $row->id)
                        ->update(['content' => $row->description]);
                }
            });

        Schema::table('news', function (Blueprint $table): void {
            $table->dropColumn(['description', 'video_url']);
        });
    }
};

