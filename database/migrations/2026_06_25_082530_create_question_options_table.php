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
        // جدول خيارات الأسئلة
        Schema::create('question_options', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي التعريفي للخيار الفرعي للسؤال
            $table->foreignId('question_bank_id')->constrained()->onDelete('cascade'); // يربط مجموعة الخيارات المتعددة بالسؤال الأم التابعة له في البنك
            $table->string('option_text', 255); // النص أو الحقل الرقمي المعروض كخيار للحل أمام الطالب
            $table->boolean('is_correct'); // علم منطقي (true/false) يعتمد الإجابة الصحيحة للتصحيح الفوري تلقائياً
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};
