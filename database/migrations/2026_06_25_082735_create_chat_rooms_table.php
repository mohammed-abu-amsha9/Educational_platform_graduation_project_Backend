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
        // جدول غرف المحادثات
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي لتعريف قناة وغرفة التواصل الفردية
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // المعلم المشترك بداخل هذه المحادثة الفردية الحالية
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // الطالب (أو حساب ولي أمره المتابع) المشترك في نفس الغرفة
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_rooms');
    }
};
