<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IterationFinalGrade extends Model
{
    protected $fillable = [
        'name',
        'npm',
        'semester_5_1',
        'semester_5_2',
        'semester_6_1',
        'semester_6_2',
        'semester_7_1',
        'semester_7_2',
        'profile_kelulusan',
    ];
}
