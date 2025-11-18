<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Protocol extends Model
{
    protected $fillable = [
        'year',
        'title',
        'title_kk',
        'file_path',
        'file_path_kk',
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

    public function getLocalizedTitleAttribute(): string
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
        $path = $this->localized_file_path;
        return $path ? Storage::disk('public')->url($path) : null;
    }
}
