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
        // جدول نتائج وعلامات الطلاب
        Schema::create('student_exam_results', function (Blueprint $table) {
            $table->id(); // رقم وثيقة الرصد الكلي للعلامة والدرجة النهائيةالطالب
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // يربط العلامة النهائية الكلية بالطالب صاحب التقييم
            $table->foreignId('exam_id')->constrained()->onDelete('cascade'); // يربط النتيجة بالامتحان الإجمالي الذي تم رصده وتصحيحه
            $table->integer('score_obtained'); // الدرجة الرقمية الكلية المحصلة والمستحقة للطالب فور إنهاء الحل
            $table->string('status', 50); // حالة رصد النتيجة وتدقيقها (مصحح تلقائياً، تم رصده، غياب تلقائي)
            $table->string('submission_method', 100); // طريقة تقديم الطالب للامتحان (حساب الطالب الإلكتروني أو لم يدخل)
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_exam_results');
    }
};
