<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnnouncementCategory extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
    ];

    /**
     * Получить объявления этой категории
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function getLocalizedTitleAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->title_kk) {
            return $this->title_kk;
        }

        return $this->title;
    }
}
