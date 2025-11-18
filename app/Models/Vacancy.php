<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'description',
        'description_kk',
        'schedule',
        'schedule_kk',
        'contact_info',
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

    public function getLocalizedScheduleAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->schedule_kk) {
            return $this->schedule_kk;
        }

        return $this->schedule;
    }
}
