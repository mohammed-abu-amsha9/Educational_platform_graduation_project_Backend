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
        // غرف المحادثات
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('teacher_id')->constrained()->cascadeOnDelete(); // المعلم المشترك بداخل هذه المحادثة الفردية الحالية
            $table->foreignId('student_id')->constrained()->cascadeOnDelete(); // الطالب (أو حساب ولي أمره المتابع) المشترك في نفس الغرفة
            $table->timestamps();
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
