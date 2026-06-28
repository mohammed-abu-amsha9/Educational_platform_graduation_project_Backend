<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /** @use HasFactory<\Database\Factories\ExamFactory> */
    use HasFactory;

    // متعدد لمتعدد (Many-to-Many). الامتحان يحتوي على أسئلة كثيرة، والسؤال يمكن أن يتكرر في امتحانات كثيرة.
    public function questions()
    {
        return $this->belongsToMany(QuestionBank::class, 'exam_questions', 'exam_id', 'question_bank_id');
    }
}
