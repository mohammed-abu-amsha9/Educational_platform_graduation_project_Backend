<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grade_teacher extends Model
{
    /** @use HasFactory<\Database\Factories\GradeTeacherFactory> */
    use HasFactory;

    // تعريف الجدول المرتبط
    protected $table = 'grade_teachers';

    // العلاقة مع الصف (Grade)
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }

    // العلاقة مع الشعبة (Section)
    public function section()
    {
        return $this->belongsTo(section::class, 'section_id');
    }
}
