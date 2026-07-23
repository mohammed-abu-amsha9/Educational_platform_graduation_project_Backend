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
        // جدول الاختبارات
        Schema::create('exams', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete(); // المعلم منشئ الامتحان والمسؤول الأول عن نشر تقييمه
            $table->string('title', 150); // عنوان الامتحان ومسمى المادة (مثل: اختبار الكيمياء النصفي)
            $table->integer('Exam_duration'); // مدة الاختبار بالدقائق لضبط ساعة العداد التنازلي البرمجي
            $table->integer('total_questions'); // عدد الأسئلة الإجمالي التي سيتعرض لها الطالب في الامتحان
            $table->string('Total_score'); // مجموع العلامة الكلي
            $table->string('Start_time'); // من الساعة كم متاح الاختبار
            $table->string('End_Time'); // الى الساعة كم متاح الاختبار
            $table->enum('status', ['Unpublished', 'Published'])->default('Unpublished'); // حالة الاختبار منشور او غير منشور
            $table->timestamps();
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
