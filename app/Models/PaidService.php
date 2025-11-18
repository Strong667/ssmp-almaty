<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class PaidService extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'description',
        'description_kk',
        'file',
        'file_kk',
    ];

    /**
     * Услуги платной услуги
     */
    public function items(): HasMany
    {
        return $this->hasMany(PaidServiceItem::class)->orderBy('order');
    }

    /**
     * Получить URL файла
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file ? Storage::disk('public')->url($this->file) : null;
    }

    public function getLocalizedTitleAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->title_kk) {
            return $this->title_kk;
        }

        return $this->title;
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->description_kk) {
            return $this->description_kk;
        }

        return $this->description;
    }

    public function getLocalizedFileAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file_kk) {
            return $this->file_kk;
        }

        return $this->file;
    }

    public function getLocalizedFileUrlAttribute(): ?string
    {
        $file = $this->localized_file;
        return $file ? Storage::disk('public')->url($file) : null;
    }
}
