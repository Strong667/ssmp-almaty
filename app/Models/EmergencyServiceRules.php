<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyServiceRules extends Model
{
    protected $fillable = [
        'text',
        'text_kk',
    ];

    public function getLocalizedTextAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->text_kk) {
            return $this->text_kk;
        }

        return $this->text;
    }
}
