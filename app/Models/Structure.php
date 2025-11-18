<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Structure extends Model
{
    protected $fillable = [
        'title',
        'image',
        'image_kk',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    public function getImageKkUrlAttribute(): ?string
    {
        return $this->image_kk ? Storage::disk('public')->url($this->image_kk) : null;
    }

    public function getLocalizedImageUrlAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->image_kk) {
            return $this->image_kk_url;
        }

        return $this->image_url;
    }
}
