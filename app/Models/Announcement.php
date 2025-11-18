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
        'text_kk',
        'file_path',
        'file_path_kk',
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

    public function getLocalizedTextAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->text_kk) {
            return $this->text_kk;
        }

        return $this->text;
    }

    public function getLocalizedFilePathAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file_path_kk) {
            return $this->file_path_kk;
        }

        return $this->file_path;
    }

    public function getLocalizedFileUrlAttribute(): ?string
    {
        $path = $this->localized_file_path;
        return $path ? Storage::disk('public')->url($path) : null;
    }
}
