<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeExpenseReport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'title_kk',
        'file_path',
        'file_path_kk',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
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
        return $path ? \Illuminate\Support\Facades\Storage::disk('public')->url($path) : null;
    }
}
