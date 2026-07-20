<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;

    /**
     * جلب كافة الشعب التابعة لهذا الصف
     */
    public function sections()
    {
        return $this->hasMany(section::class, 'grade_id');
    }

    /**
     * جلب كافة المواد التابعة لهذا الصف
     */
    public function subjects()
    {
        return $this->hasMany(subject::class, 'grade_id');
    }

    /**
     * جلب كافة الطلاب المسجلين في هذا الصف الدراسي
     */
    public function students()
    {
        return $this->hasMany(Student::class, 'grade_id');
    }

    /**
     * جلب كافة المعلمين الذين يدرسون في هذا الصف
     */
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'grade_teachers', 'grade_id', 'teacher_id');    }
}
