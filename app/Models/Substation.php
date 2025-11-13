<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Substation extends Model
{
    protected $fillable = [
        'number',
        'address',
        'brigades_count',
        'doctors_count',
        'paramedics_count',
        'junior_staff_count',
    ];

    protected $casts = [
        'number' => 'integer',
        'brigades_count' => 'integer',
        'doctors_count' => 'integer',
        'paramedics_count' => 'integer',
        'junior_staff_count' => 'integer',
    ];
}
