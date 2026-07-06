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
        // جدول بنك الاسئلة
        Schema::create('question_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // المعلم معد ومبتكر هذا السؤال البرمجي
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // المعلم معد ومبتكر هذا السؤال البرمجي
            $table->text('question_text'); // نص ومضمون السؤال التعليمي الظاهر للطلاب أثناء تقديم التقييم
            $table->string('question_type', 30); // نوع طبيعة السؤال البرمجية (الاختيار من متعدد mcq / صح وخطأ true_false)
            $table->string('difficulty_level', 30); // مستوى الصعوبة المعتمد للمولد الذكي للامتحانات (easy/medium/hard)
            $table->timestamps();
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
