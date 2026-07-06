<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class assignment_submission extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentSubmissionFactory> */
    use HasFactory;

    /** الواجب الأصلي التابع له هذا التسليم */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }

    /** الطالب الذي قام برفع هذا الحل */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
