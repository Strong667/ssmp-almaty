<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anticorruption extends Model
{
    protected $fillable = [
        'title',
        'description',
        'service_tasks',
        'call_center',
        'compliance_officer',
    ];

    /**
     * Изображения антикоррупции
     */
    public function images(): HasMany
    {
        return $this->hasMany(AnticorruptionImage::class)->orderBy('is_header', 'desc')->orderBy('order');
    }

    /**
     * Изображение для заголовка
     */
    public function headerImage()
    {
        return $this->hasOne(AnticorruptionImage::class)->where('is_header', true);
    }
}
