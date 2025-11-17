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
        
        // Перед сохранением
        static::saving(function ($model) {
            // Автоматически устанавливаем order при создании
            if (!$model->exists) {
                $maxOrder = static::query()->max('order') ?? -1;
                $model->order = $maxOrder + 1;
            }
            
            // Обрабатываем video_content и переносим в content для типа video
            if ($model->type === 'video') {
                $videoContent = request()->input('video_content');
                if ($videoContent !== null && $videoContent !== '') {
                    // Сохраняем video_content в content
                    $model->content = trim($videoContent);
                } elseif (!$model->exists && empty($model->content)) {
                    // Если это новый блок и video_content пустой, берем из запроса еще раз
                    $videoContent = request()->input('video_content', '');
                    if (!empty($videoContent)) {
                        $model->content = trim($videoContent);
                    }
                }
            }
            
            // Удаляем video_content из атрибутов модели, чтобы не попало в SQL запрос
            if ($model->getAttributes() && array_key_exists('video_content', $model->getAttributes())) {
                unset($model->attributes['video_content']);
            }
        });
        
        // После сохранения
        static::saved(function ($model) {
            // Очищаем content для типов, где он не нужен, только если file_path был сохранен
            if (($model->type === 'pdf' || $model->type === 'images') && $model->content && $model->file_path) {
                $model->content = null;
                $model->saveQuietly(); // Сохраняем без вызова хуков
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
