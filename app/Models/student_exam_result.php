<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_exam_result extends Model
{
    /** @use HasFactory<\Database\Factories\StudentExamResultFactory> */
    use HasFactory;
    protected $fillable = [
        'student_id',
        'exam_id',
        'score_obtained',
        'status',
        'submission_method',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
