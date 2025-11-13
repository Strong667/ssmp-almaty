<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialInsurance extends Model
{
    protected $fillable = [
        'type',
        'content',
        'image',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
    
    // Временный атрибут для обработки видео URL из формы
    protected $appends = [];
    
    public function setVideoContentAttribute($value)
    {
        if ($this->type === 'video' && $value !== null) {
            $this->attributes['content'] = $value;
        }
    }
}
