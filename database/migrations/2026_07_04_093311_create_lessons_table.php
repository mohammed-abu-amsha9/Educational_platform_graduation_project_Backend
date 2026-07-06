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
        // جدول الدروس
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // يربط الدرس بالمعلم الناشر والمعد للمادة الشارحة
            $table->foreignId('subject_id')->constrained()->onDelete('cascade'); // يربط الدرس بالمعلم الناشر والمعد للمادة الشارحة
            $table->string('title', 200); // عنوان المحاضرة (مثل: الكيمياء الأساسية وعناصر الجدول الدوري)
            $table->string('file_type', 50); // نوع الملف المرفق لدعم الواجهة (فيديو شرح، ملف PDF)
            $table->string('file_url', 255); // المسار السحابي أو رابط تخزين الملف على خوادم المنصة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
