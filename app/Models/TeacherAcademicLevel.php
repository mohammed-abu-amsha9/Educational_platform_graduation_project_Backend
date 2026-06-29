<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeacherAcademicLevel extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherAcademicLevelFactory> */
    use HasFactory, SoftDeletes;
}
