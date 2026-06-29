<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    /** @use HasFactory<\Database\Factories\LessonFactory> */
    use HasFactory, SoftDeletes;

    // واحد لمتعدد (One-to-Many). المعلم الواحد يقوم بنشر العديد من الدروس
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // واحد لمتعدد (One-to-Many). الدرس الواحد يمكن توجيهه لأكثر من شعبة
    public function sections()
    {
        return $this->hasMany(LessonSection::class, 'lesson_id');
    }
}
