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
        'description',
    ];

    /**
     * Подстанция
     */
    public function substation(): BelongsTo
    {
        return $this->belongsTo(Substation::class);
    }
}
