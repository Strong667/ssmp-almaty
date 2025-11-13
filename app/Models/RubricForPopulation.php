<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class RubricForPopulation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'type',
        'content',
        'file_path',
        'images',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'images' => 'array',
    ];
    
    /**
     * Boot метод для обработки событий модели
     */
    protected static function boot()
    {
        parent::boot();
        
        // Перед сохранением удаляем video_content из атрибутов
        static::saving(function ($model) {
            if ($model->getAttributes() && array_key_exists('video_content', $model->getAttributes())) {
                unset($model->attributes['video_content']);
            }
        });
    }

    /**
     * Получить URL изображения
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    /**
     * Получить URL файла PDF или изображения
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? Storage::disk('public')->url($this->file_path) : null;
    }

    /**
     * Получить массив URL изображений
     */
    public function getImagesUrlsAttribute(): array
    {
        if (!$this->images || !is_array($this->images)) {
            return [];
        }

        return array_map(function ($image) {
            return Storage::disk('public')->url($image);
        }, $this->images);
    }
}
