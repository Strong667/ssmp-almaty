<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Substation extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
    ];

    /**
     * Сотрудники подстанции
     */
    public function employees(): HasMany
    {
        return $this->hasMany(SubstationEmployee::class);
    }
}
