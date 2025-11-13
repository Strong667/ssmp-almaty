<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalEmploymentInfo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'attachment',
    ];
}
