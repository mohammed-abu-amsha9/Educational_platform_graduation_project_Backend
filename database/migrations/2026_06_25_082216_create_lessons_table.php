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
        // جدول الدروس والمواد التعليمية
        Schema::create('lessons', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي للدرس أو المحاضرة
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // يربط الدرس بالمعلم الناشر والمعد للمادة الشارحة
            $table->string('subject_name', 100); // اسم المادة التعليمية التابع لها المحتوى
            $table->string('title', 200); // عنوان المحاضرة (مثل: الكيمياء الأساسية وعناصر الجدول الدوري)
            $table->string('file_type', 50); // نوع الملف المرفق لدعم الواجهة (فيديو شرح، ملف PDF)
            $table->string('file_url', 255); // المسار السحابي أو رابط تخزين الملف على خوادم المنصة
            $table->integer('views_count')->default(0); // عداد إجمالي عدد المشاهدات والزيارات للدرس من الطلاب
            $table->integer('downloads_count')->default(0); // عداد لتتبع عدد مرات تحميل الملف النصي المرفق
            $table->timestamps(); // سينتج عنها تلقائياً حقل created_at وهو وقت وتاريخ نشر وإتاحة المحتوى على لوحة الطالب
            $table->softDeletes();
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
