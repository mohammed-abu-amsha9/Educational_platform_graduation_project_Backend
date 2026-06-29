<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory, SoftDeletes;

    // واحد لمتعدد (One-to-Many). الدور الواحد يمتلكه العديد من المعلمين
    public function role()
    {
        return $this->belongsTo(RolePermission::class, 'role_id');
    }


    // واحد لمتعدد (One-to-Many). المعلم الواحد يدرّس في عدة صفوف/شعب
    public function academicLevels()
    {
        return $this->hasMany(TeacherAcademicLevel::class, 'teacher_id');
    }

    // واحد لمتعدد (One-to-Many). المعلم الواحد يقوم بنشر العديد من الدروس
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    // المعلم ينشئ امتحانات وأسئلة متعددة
    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }
    public function questions()
    {
        return $this->hasMany(QuestionBank::class, 'teacher_id');
    }
}
