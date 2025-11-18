<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Substation extends Model
{
    protected $fillable = [
        'name',
        'name_kk',
        'address',
        'address_kk',
        'phone',
    ];

    public function getLocalizedNameAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->name_kk) {
            return $this->name_kk;
        }

        return $this->name;
    }

    public function getLocalizedAddressAttribute(): ?string
    {
        if (app()->getLocale() === 'kk' && $this->address_kk) {
            return $this->address_kk;
        }

        return $this->address;
    }

    /**
     * Сотрудники подстанции
     */
    public function employees(): HasMany
    {
        return $this->hasMany(SubstationEmployee::class);
    }
}
