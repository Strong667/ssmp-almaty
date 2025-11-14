<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectorBlog extends Model
{
    protected $fillable = [
        'photo',
        'full_name',
        'personal_info',
        'birth_date',
        'education',
        'career',
        'associate_professor_ram',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
