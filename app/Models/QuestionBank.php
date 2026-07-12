<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;

    /** المعلم الذي أضاف السؤال */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }
    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id');
    }

    /** خيارات الإجابة التابعة لهذا السؤال */
    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_bank_id');
    }

    /** الامتحانات التي تحتوي على هذا السؤال */
    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions', 'question_bank_id', 'exam_id');
    }

    public function questionBank()
    {
        // السهم يشير إلى جدول بنك الأسئلة الأساسي عبر المفتاح الأجنبي
        return $this->belongsTo(QuestionBank::class, 'question_bank_id');
    }
}
