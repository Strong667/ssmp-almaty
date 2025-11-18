<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StateAnthem extends Model
{
    protected $fillable = [
        'image',
        'description',
        'description_kk',
        'text',
        'audio_file',
    ];

    /**
     * Получить URL изображения
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    /**
     * Получить URL аудио файла
     */
    public function getAudioUrlAttribute(): ?string
    {
        return $this->audio_file ? Storage::disk('public')->url($this->audio_file) : null;
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->description_kk) {
            return $this->description_kk;
        }

        return $this->description;
    }
}
