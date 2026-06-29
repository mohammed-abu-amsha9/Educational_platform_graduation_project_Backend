<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PendingAction extends Model
{
    /** @use HasFactory<\Database\Factories\PendingActionFactory> */
    use HasFactory, SoftDeletes;

    // يرتبط بالطالب الذي نفذ العملية أثناء انقطاع الشبكة
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
