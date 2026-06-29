<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentMonthlyFee extends Model
{
    /** @use HasFactory<\Database\Factories\StudentMonthlyFeeFactory> */
    use HasFactory, SoftDeletes;

    // واحد لمتعدد (One-to-Many). الطالب الواحد لديه عدة مطالبات مالية شهرية
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
