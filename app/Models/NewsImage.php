<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NewsImage extends Model
{
    protected $fillable = [
        'news_id',
        'image',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Новость
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class);
    }

    /**
     * Получить публичный URL изображения
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image
            ? route('storage.public', ['path' => $this->image])
            : null;
    }
}
