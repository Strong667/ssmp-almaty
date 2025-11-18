<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anticorruption extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'description',
        'description_kk',
        'service_tasks',
        'service_tasks_kk',
        'call_center',
        'compliance_officer',
    ];

    /**
     * Изображения антикоррупции
     */
    public function images(): HasMany
    {
        return $this->hasMany(AnticorruptionImage::class)->orderBy('is_header', 'desc')->orderBy('order');
    }

    /**
     * Изображение для заголовка
     */
    public function headerImage()
    {
        return $this->hasOne(AnticorruptionImage::class)->where('is_header', true);
    }

    /**
     * Получить локализованный заголовок
     */
    public function getLocalizedTitleAttribute(): string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->title_kk) {
            return $this->title_kk;
        }
        return $this->title;
    }

    /**
     * Получить локализованное описание
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->description_kk) {
            return $this->description_kk;
        }
        return $this->description;
    }

    /**
     * Получить локализованные задачи службы
     */
    public function getLocalizedServiceTasksAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->service_tasks_kk) {
            return $this->service_tasks_kk;
        }
        return $this->service_tasks;
    }
}
