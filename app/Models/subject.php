<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    // العلاقة: المادة تنتمي إلى صف دراسي محدد
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    // العلاقة: المادة يدرسها العديد من المعلمين
    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teachers', 'subject_id', 'teacher_id');
    }

    // المادة الواحدة تحتوي على عدة دروس
    public function lessons()
    {
        return $this->hasMany(lesson::class, 'subject_id');
    }
}
