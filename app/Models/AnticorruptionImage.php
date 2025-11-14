<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnticorruptionImage extends Model
{
    protected $fillable = [
        'anticorruption_id',
        'image',
        'is_header',
        'order',
    ];

    protected $casts = [
        'is_header' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Антикоррупция
     */
    public function anticorruption(): BelongsTo
    {
        return $this->belongsTo(Anticorruption::class);
    }
}
