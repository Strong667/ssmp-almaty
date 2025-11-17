<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalEmploymentInfo extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file1_name',
        'file1',
        'file2_name',
        'file2',
        'file3_name',
        'file3',
    ];
}
