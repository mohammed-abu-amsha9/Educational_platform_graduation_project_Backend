<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // جدول تفاصيل إجابات الطلاب
        Schema::create('student_exam_answers', function (Blueprint $table) {
            $table->id(); // المعرف الفريد لحركة حل وضغط زر الطالب بداخل الامتحان
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade'); // يرتبط بالطالب الفرد الذي يقوم بتقديم الإجابة حالياً
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade'); // رقم الامتحان الإجمالي المحلول داخله السؤال
            $table->foreignId('question_bank_id')->constrained()->onDelete('cascade'); // معرف السؤال الدقيق الذي تتم الإجابة عليه الآن من الطالب
            $table->foreignId('selected_option_id')->constrained('question_options')->onDelete('cascade'); // رقم الخيار الدقيق والمحفوظ الذي ضغط عليه الطالب كحل للسؤال
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_answers');
    }
};
