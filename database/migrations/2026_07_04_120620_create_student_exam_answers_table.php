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
        // جدول اجابات الطلاب على الاختبارات
        Schema::create('student_exam_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete(); // يرتبط بالطالب الفرد الذي يقوم بتقديم الإجابة حالياً
            $table->foreignId('exam_id')->constrained()->cascadeOnDelete(); // رقم الامتحان الإجمالي المحلول داخله السؤال
            $table->foreignId('question_bank_id')->constrained()->cascadeOnDelete(); // معرف السؤال الدقيق الذي تتم الإجابة عليه الآن من الطالب
            $table->foreignId('selected_option_id')->constrained('question_options')->cascadeOnDelete(); // رقم الخيار الدقيق والمحفوظ الذي ضغط عليه الطالب كحل للسؤال
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
