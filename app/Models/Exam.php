<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory, SoftDeletes;

    // متعدد لمتعدد (Many-to-Many). الامتحان يحتوي على أسئلة كثيرة، والسؤال يمكن أن يتكرر في امتحانات كثيرة.
    public function questions()
    {
        return $this->belongsToMany(QuestionBank::class, 'exam_questions', 'exam_id', 'question_bank_id');
    }

    /** المعلم منشئ الامتحان */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    /** الطلاب الذين دخلوا هذا الامتحان وسجلات دخولهم */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_exams', 'exam_id', 'student_id')
            ->withPivot('enter_time', 'submit_time') // لجلب أوقات الدخول والتسليم من الجدول الوسيط
            ->withTimestamps();
    }

    /** نتائج الطلاب في هذا الامتحان */
    public function results()
    {
        return $this->hasMany(StudentExamResult::class, 'exam_id');
    }
}
