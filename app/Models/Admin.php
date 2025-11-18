<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Admin extends Model
{
    protected $fillable = [
        'full_name',
        'position',
        'position_kk',
        'email',
        'image',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::disk('public')->url($this->image) : null;
    }

    public function getLocalizedPositionAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->position_kk) {
            return $this->position_kk;
        }

        return $this->position;
    }
}
