<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProcurementPlan extends Model
{
    protected $fillable = [
        'title',
        'year',
        'file_path',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

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
