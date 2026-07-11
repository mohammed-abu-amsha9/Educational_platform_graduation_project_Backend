<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory, SoftDeletes;

    /**
     * جلب الدور الوظيفي الذي ينتمي إليه هذا المعلم
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * جلب كافة المواد التي يقوم هذا المعلم بتدريسها
     */
    public function subjects()
    {
        // نحدد اسم الجدول الوسيط subject_teachers
        return $this->belongsToMany(Subject::class, 'subject_teachers', 'teacher_id', 'subject_id');
    }

    /**
     * جلب كافة الصفوف الدراسية التي يقوم هذا المعلم بالتدريس فيها
     */
    public function grades()
    {
        return $this->belongsToMany(Grade::class, 'grade_teachers', 'teacher_id', 'grade_id');
    }
    /**
     * جلب جميع الدروس التي نشرها المعلم
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id');
    }

    /**
     * جلب سجلات الحضور والغياب التي قام هذا المعلم برصدها
     */
    public function attendanceLogs()
    {
        return $this->hasMany(attendance_log::class, 'teacher_id');
    }

    /** الأسئلة التي ابتكرها المعلم في البنك */
    public function questionBank()
    {
        return $this->hasMany(QuestionBank::class, 'teacher_id');
    }

    /** الامتحانات التي أنشأها المعلم */
    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }

    /** الواجبات التي نشرها المعلم */
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'teacher_id');
    }

    /** غرف المحادثة المفتوحة مع هذا المعلم */
    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class, 'teacher_id');
    }

    // 🟢 جلب الشعب التي يدرسها المعلم بدقة (الحل السحري لمشكلتك)
    public function sections()
    {
        return $this->belongsToMany(Section::class, 'grade_teachers', 'teacher_id', 'section_id')->distinct();
    }
}
