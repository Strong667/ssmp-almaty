<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthyLifestyle extends Model
{
    protected $fillable = [
        'image_kk',
        'image_ru',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}
