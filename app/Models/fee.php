<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    /** @use HasFactory<\Database\Factories\FeeFactory> */
    use HasFactory;

    /**
     * جلب الطالب صاحب هذا القسط المالي
     */
    public function student()
    {
        return $this->belongsTo(student::class, 'student_id');
    }
}
