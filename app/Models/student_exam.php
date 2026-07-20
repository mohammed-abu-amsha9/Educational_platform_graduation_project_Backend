<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_exam extends Model
{
    /** @use HasFactory<\Database\Factories\StudentExamFactory> */
    use HasFactory;

    protected  $fillable =[
        'student_id',
        'exam_id',
        'enter_time',
        'submit_time'
    ];
}
