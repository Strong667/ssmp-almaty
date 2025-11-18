<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegistryOfStateServices extends Model
{
    protected $fillable = [
        'text',
        'text_kk',
        'url',
    ];

    public function getLocalizedTextAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->text_kk) {
            return $this->text_kk;
        }

        return $this->text;
    }
}
