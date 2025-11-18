<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class CorruptionRiskPosition extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'file_path',
        'file_path_kk',
    ];

    /**
     * Получить URL файла
     */
    public function getFileUrlAttribute(): ?string
    {
        return $this->file_path ? Storage::disk('public')->url($this->file_path) : null;
    }

    public function getLocalizedTitleAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->title_kk) {
            return $this->title_kk;
        }

        return $this->title;
    }

    public function getLocalizedFilePathAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file_path_kk) {
            return $this->file_path_kk;
        }

        return $this->file_path;
    }

    public function getLocalizedFileUrlAttribute(): ?string
    {
        $file = $this->localized_file_path;
        return $file ? Storage::disk('public')->url($file) : null;
    }
}
