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
        // جدول الرسائل
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي لكل فقاعة ورسالة مبعوثة داخل الشات
            $table->foreignId('chat_room_id')->constrained()->onDelete('cascade'); // يربط الرسالة الحالية بغرفة المحادثة الشاملة التابعة لها
            $table->string('sender_type', 20); // تحديد جهة فئة المرسل لحقن وترتيب الرسالة في الواجهات (teacher/student)
            $table->text('message_text'); // المضمون والنص المكتوب والمتبادل بداخل الشات التعليمي المباشر
            $table->string('attachment_url', 255)->nullable(); // رابط أو مسار ملف أو صورة مرفقة بشكل اختياري بداخل حزمة الرسالة
            $table->boolean('is_read')->default(false); // حقل منطقي لتفعيل علامة المقروئية والنقطة الزرقاء بواجهة التطبيق
            $table->timestamps(); // سينتج عنها created_at وقت إرسال الرسالة بدقة متناهية لغايات ترتيب خط الدردشة الزمني
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
