<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table): void {
            $table->string('slug')->nullable()->after('title');
            $table->unique('slug');
        });

        DB::table('news')
            ->select('id', 'title')
            ->orderBy('id')
            ->chunkById(100, function ($rows): void {
                foreach ($rows as $row) {
                    if (! $row->title) {
                        continue;
                    }

                    $base = Str::slug($row->title) ?: 'news';
                    $slug = $base;
                    $suffix = 1;

                    while (
                        DB::table('news')
                            ->where('id', '!=', $row->id)
                            ->where('slug', $slug)
                            ->exists()
                    ) {
                        $slug = "{$base}-{$suffix}";
                        $suffix++;
                    }

                    DB::table('news')
                        ->where('id', $row->id)
                        ->update(['slug' => $slug]);
                }
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table): void {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};

