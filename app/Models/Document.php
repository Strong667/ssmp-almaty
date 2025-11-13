<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = [
        'corporate_document_id',
        'title',
        'file_path',
    ];

    /**
     * Получить категорию документа
     */
    public function corporateDocument(): BelongsTo
    {
        return $this->belongsTo(CorporateDocument::class);
    }

    /**
     * Получить URL файла
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path
            ? Storage::disk('public')->url($this->file_path)
            : null;
    }
}
