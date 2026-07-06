<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question_option extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionOptionFactory> */
    use HasFactory;

    /** السؤال الأم الذي يتبع له هذا الخيار */
    public function question()
    {
        return $this->belongsTo(QuestionBank::class, 'question_bank_id');
    }
}
