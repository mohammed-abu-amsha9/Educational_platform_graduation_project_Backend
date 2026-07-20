<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory;

    /**
     * جلب المعلم الذي قام بإعداد ونشر هذا الدرس
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // الدرس ينتمي إلى مادة
    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id');
    }
}
