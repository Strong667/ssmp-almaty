<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsmpStructure extends Model
{
    protected $table = 'ssmp_structures';

    protected $fillable = [
        'substation_number',
        'address',
        'address_kk',
        'brigades_count',
        'doctors_count',
        'paramedics_count',
        'junior_staff_count',
        'order',
    ];

    public function getLocalizedAddressAttribute(): string
    {
        if (app()->getLocale() === 'kk' && $this->address_kk) {
            return $this->address_kk;
        }

        return $this->address;
    }
}
