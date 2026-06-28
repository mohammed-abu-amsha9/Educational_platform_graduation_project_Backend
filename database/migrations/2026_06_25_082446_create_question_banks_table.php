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
        // جدول الأسئلة المركزي
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي لكل سؤال بداخل مستودع الأسئلة
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // المعلم معد ومبتكر هذا السؤال البرمجي
            $table->string('academic_level_subject', 150); // تصنيف وتحديد الصف والمادة التابع لها السؤال لغايات الفلترة
            $table->text('question_text'); // نص ومضمون السؤال التعليمي الظاهر للطلاب أثناء تقديم التقييم
            $table->string('question_type', 30); // نوع طبيعة السؤال البرمجية (الاختيار من متعدد mcq / صح وخطأ true_false)
            $table->string('difficulty_level', 30); // مستوى الصعوبة المعتمد للمولد الذكي للامتحانات (easy/medium/hard)
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_banks');
    }
};
