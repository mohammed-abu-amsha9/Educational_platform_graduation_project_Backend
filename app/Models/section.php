<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    /** @use HasFactory<\Database\Factories\SectionFactory> */
    use HasFactory;

    /**
     * جلب الصف الذي تتبع له هذه الشعبة
     */
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}
