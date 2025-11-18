<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'slug',
        'description',
        'description_kk',
        'video_url',
        'image',
        'published_at',
        'is_featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($news) {
            if (!$news->slug || $news->isDirty('title')) {
                $news->slug = static::makeUniqueSlug($news);
            }
        });
    }

    /**
     * Генерация уникального slug
     *
     * @param  News  $item
     * @return string
     */
    private static function makeUniqueSlug(News $item): string
    {
        $base = Str::slug($item->title ?? '', '-', 'ru')
            ?: Str::slug($item->title ?? '', '-', app()->getFallbackLocale())
                ?: 'news';

        $slug = $base;
        $suffix = 1;

        while (
            static::query()
                ->where('slug', $slug)
                ->when($item->exists, fn($q) => $q->where('id', '!=', $item->id))
                ->exists()
        ) {
            $slug = "{$base}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }

    public function getDisplayDateAttribute(): string
    {
        $date = $this->published_at ?? $this->created_at;
        
        if (!$date) {
            return '';
        }

        $months = [
            1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
            5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
            9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'
        ];

        return $date->format('d') . ' ' . $months[$date->format('n')] . ', ' . $date->format('Y');
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
     * Изображения новости
     */
    public function images(): HasMany
    {
        return $this->hasMany(NewsImage::class)->orderBy('created_at');
    }
}
