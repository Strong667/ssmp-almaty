<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EthicalCode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'title_kk',
        'pdf_path',
        'pdf_path_kk',
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

    public function getLocalizedPdfPathAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->pdf_path_kk) {
            return $this->pdf_path_kk;
        }

        return $this->pdf_path;
    }

    public function getLocalizedPdfUrlAttribute(): ?string
    {
        $path = $this->localized_pdf_path;
        return $path ? \Illuminate\Support\Facades\Storage::disk('public')->url($path) : null;
    }
}
