<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Announcement extends Model
{
    protected $fillable = [
        'announcement_category_id',
        'text',
        'file_path',
    ];

    /**
     * Получить категорию объявления
     */
    public function announcementCategory(): BelongsTo
    {
        return $this->belongsTo(AnnouncementCategory::class);
    }

    /**
     * Получить URL файла
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path
            ? Storage::disk('public')->url($this->file_path)
            : null;
    }
}
