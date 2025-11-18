<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaidServiceItem extends Model
{
    protected $fillable = [
        'paid_service_id',
        'name',
        'unit',
        'price',
        'order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'order' => 'integer',
    ];

    /**
     * Платная услуга
     */
    public function paidService(): BelongsTo
    {
        return $this->belongsTo(PaidService::class);
    }
}
