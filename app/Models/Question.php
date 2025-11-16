<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'name',
        'email',
        'question',
        'answer',
        'published',
        'notify_email',
    ];

    protected $casts = [
        'published' => 'boolean',
        'notify_email' => 'boolean',
    ];
}
