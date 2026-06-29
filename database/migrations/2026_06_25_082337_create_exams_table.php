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
        // جدول الامتحانات
        Schema::create('exams', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي للاختبار المولد من البنك
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // المعلم منشئ الامتحان والمسؤول الأول عن نشر تقييمه
            $table->string('title', 150); // عنوان الامتحان ومسمى المادة (مثل: اختبار الكيمياء النصفي)
            $table->string('academic_level_subject', 150); // تخزين وتحديد المادة والصف الدراسي التابع له الامتحان
            $table->integer('duration_minutes'); // مدة الاختبار بالدقائق لضبط ساعة العداد التنازلي البرمجي
            $table->integer('total_questions'); // عدد الأسئلة الإجمالي التي سيتعرض لها الطالب في الامتحان
            $table->timestamps(); // سينتج عنها created_at وهو وقت وتاريخ إصدار ونشر الامتحان للطلاب على المنصة
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
