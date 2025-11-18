<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionOfEmergencyService extends Model
{
    protected $fillable = [
        'image',
        'image_kk',
    ];

    /**
     * Получить локализованное изображение
     */
    public function getLocalizedImageAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->image_kk) {
            return $this->image_kk;
        }
        return $this->image;
    }

    /**
     * Получить URL локализованного изображения
     */
    public function getLocalizedImageUrlAttribute(): ?string
    {
        $image = $this->localized_image;
        return $image ? route('storage.public', ['path' => $image]) : null;
    }
}
