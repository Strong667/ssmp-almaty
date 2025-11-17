<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SsmpStructure extends Model
{
    protected $table = 'ssmp_structures';

    protected $fillable = [
        'substation_number',
        'address',
        'brigades_count',
        'doctors_count',
        'paramedics_count',
        'junior_staff_count',
        'order',
    ];
}
