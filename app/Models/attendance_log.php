<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance_log extends Model
{
    /** @use HasFactory<\Database\Factories\AttendanceLogFactory> */
    use HasFactory;
    // الحقول المسموح بحفظها وتحديثها جماعياً
    protected $fillable = [
        'student_id',
        'date',
        'teacher_id',
        'status'
    ];
    /**
     * جلب الطالب المرصود له هذا السجل الحركي
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * جلب المعلم الذي قام برصد هذا الحضور/الغياب
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
