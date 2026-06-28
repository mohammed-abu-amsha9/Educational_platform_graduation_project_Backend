<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceLogFactory> */
    use HasFactory;

    // السجل ينتمي لطالب محدد ومعلم محدد قام برصده.
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
