<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionBank extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionBankFactory> */
    use HasFactory, SoftDeletes;

    // واحد لمتعدد (One-to-Many). السؤال الواحد يمتلك عدة خيارات (4 خيارات مثلاً)
    public function options()
    {
        return $this->hasMany(QuestionOption::class, 'question_bank_id');
    }
}
