<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMonthlyFee extends Model
{
    /** @use HasFactory<\Database\Factories\StudentMonthlyFeeFactory> */
    use HasFactory;

    // واحد لمتعدد (One-to-Many). الطالب الواحد لديه عدة مطالبات مالية شهرية
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
