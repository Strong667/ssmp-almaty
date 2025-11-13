<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class StateEmblem extends Model
{
    protected $fillable = [
        'image',
        'description',
    ];

    /**
     * Получить URL изображения
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }
}
