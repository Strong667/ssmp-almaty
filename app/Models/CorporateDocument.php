<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CorporateDocument extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'file_path',
        'file_path_kk',
    ];

    public function getLocalizedTitleAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->title_kk) {
            return $this->title_kk;
        }

        return $this->title;
    }

    /**
     * Получить документы этой категории
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
