<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CorporateDocument extends Model
{
    protected $fillable = [
        'title',
        'file_path',
    ];

    /**
     * Получить документы этой категории
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
