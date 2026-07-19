<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentExamAnswer extends Model
{
    /** @use HasFactory<\Database\Factories\StudentExamAnswerFactory> */
    use HasFactory;

    protected $fillable = [
        'student_id',
        'exam_id',
        'question_bank_id',
        'selected_option_id',
    ];
}
