<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    /** @use HasFactory<\Database\Factories\AssignmentFactory> */
    use HasFactory;

    /** المعلم الذي نشر هذا الواجب */
    public function teacher()
    {
        return $this->belongsTo(teacher::class, 'teacher_id');
    }
    public function subject()
    {
        return $this->belongsTo(subject::class, 'subject_id');
    }
    public function grade()
    {
        return $this->belongsTo(grade::class, 'grade_id');
    }
    public function section()
    {
        return $this->belongsTo(section::class, 'section_id');
    }


    /** كافة الحلول والتسليمات المرفوعة من الطلاب على هذا الواجب */
    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id');
    }
}
