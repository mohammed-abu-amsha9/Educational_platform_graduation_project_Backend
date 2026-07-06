<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_exam_answer extends Model
{
    /** @use HasFactory<\Database\Factories\StudentExamAnswerFactory> */
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    public function question()
    {
        return $this->belongsTo(QuestionBank::class, 'question_bank_id');
    }

    /** الخيار الدقيق الذي حدده الطالب */
    public function selectedOption()
    {
        return $this->belongsTo(QuestionOption::class, 'selected_option_id');
    }
}
