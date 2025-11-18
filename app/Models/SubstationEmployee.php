<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubstationEmployee extends Model
{
    protected $fillable = [
        'substation_id',
        'photo',
        'full_name',
        'position',
        'position_kk',
        'description',
        'description_kk',
    ];

    public function getLocalizedPositionAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->position_kk) {
            return $this->position_kk;
        }

        return $this->position;
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->description_kk) {
            return $this->description_kk;
        }

        return $this->description;
    }

    /**
     * Подстанция
     */
    public function substation(): BelongsTo
    {
        return $this->belongsTo(Substation::class);
    }
}
