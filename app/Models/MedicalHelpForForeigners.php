<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHelpForForeigners extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'description',
        'description_kk',
    ];

    public function getLocalizedTitleAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->title_kk) {
            return $this->title_kk;
        }

        return $this->title;
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->description_kk) {
            return $this->description_kk;
        }

        return $this->description;
    }
}
