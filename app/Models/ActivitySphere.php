<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySphere extends Model
{
    protected $fillable = [
        'general_info',
        'mission',
        'goal',
        'history',
    ];
}
