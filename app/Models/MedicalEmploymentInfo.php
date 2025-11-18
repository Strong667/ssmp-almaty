<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalEmploymentInfo extends Model
{
    protected $fillable = [
        'title',
        'title_kk',
        'description',
        'description_kk',
        'file1_name',
        'file1_name_kk',
        'file1',
        'file1_kk',
        'file2_name',
        'file2_name_kk',
        'file2',
        'file2_kk',
        'file3_name',
        'file3_name_kk',
        'file3',
        'file3_kk',
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

    public function getLocalizedFile1NameAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file1_name_kk) {
            return $this->file1_name_kk;
        }

        return $this->file1_name;
    }

    public function getLocalizedFile1Attribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file1_kk) {
            return $this->file1_kk;
        }

        return $this->file1;
    }

    public function getLocalizedFile2NameAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file2_name_kk) {
            return $this->file2_name_kk;
        }

        return $this->file2_name;
    }

    public function getLocalizedFile2Attribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file2_kk) {
            return $this->file2_kk;
        }

        return $this->file2;
    }

    public function getLocalizedFile3NameAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file3_name_kk) {
            return $this->file3_name_kk;
        }

        return $this->file3_name;
    }

    public function getLocalizedFile3Attribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->file3_kk) {
            return $this->file3_kk;
        }

        return $this->file3;
    }
}
