<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentSubmissionFactory> */
    use HasFactory;

    public function assignment()
    {
        return $this->belongsTo(Assignment::class, 'assignment_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
