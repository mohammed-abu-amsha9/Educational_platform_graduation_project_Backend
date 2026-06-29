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
        // جدول أسئلة الامتحانات الوسيط
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id(); // معرف فريد يمثل وجود سؤال معين بداخل امتحان معين
            $table->foreignId('exam_id')->constrained()->onDelete('cascade'); // المفتاح الأجنبي المرتبط بجدول الامتحانات الرأسية
            $table->foreignId('question_bank_id')->constrained()->onDelete('cascade'); // المفتاح الأجنبي المرتبط بالسؤال الأصلي المستدعى من البنك
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
