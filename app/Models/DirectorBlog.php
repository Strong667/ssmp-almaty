<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorBlog extends Model
{
    protected $fillable = [
        'photo',
        'full_name',
        'personal_info',
        'personal_info_kk',
        'birth_date',
        'education',
        'education_kk',
        'career',
        'career_kk',
        'awards',
        'awards_kk',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * Получить локализованную личную информацию
     */
    public function getLocalizedPersonalInfoAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->personal_info_kk) {
            return $this->personal_info_kk;
        }
        return $this->personal_info;
    }

    /**
     * Получить локализованное образование
     */
    public function getLocalizedEducationAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->education_kk) {
            return $this->education_kk;
        }
        return $this->education;
    }

    /**
     * Получить локализованную карьеру
     */
    public function getLocalizedCareerAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->career_kk) {
            return $this->career_kk;
        }
        return $this->career;
    }

    /**
     * Получить локализованные награды
     */
    public function getLocalizedAwardsAttribute(): ?string
    {
        $locale = app()->getLocale();
        if ($locale === 'kk' && $this->awards_kk) {
            return $this->awards_kk;
        }
        return $this->awards;
    }
}
