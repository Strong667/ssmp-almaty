<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class PaidService extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file',
    ];

    /**
     * Услуги платной услуги
     */
    public function items(): HasMany
    {
        return $this->hasMany(PaidServiceItem::class)->orderBy('order');
    }

    /**
     * Получить URL файла
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file ? Storage::disk('public')->url($this->file) : null;
    }
}
