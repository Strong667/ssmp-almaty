<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitizenSchedule extends Model
{
    protected $fillable = [
        'full_name',
        'position',
        'day',
        'time',
    ];
}
