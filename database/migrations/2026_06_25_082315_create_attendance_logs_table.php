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
        // جدول الحضور والغياب اليومي
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي لسجل رصد الانضباط اليومي
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // يربط الحركة بالطالب المرصود حضورياً
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // يرتبط بالمعلم الذي قام بمراجعة ورصد الحضور والغياب
            $table->date('date'); // التاريخ الفعلي والرسمي لليوم الدراسي الحاضر
            $table->enum('status', ['present', 'absent', 'late'])->default('present'); // حالة الانضباط المرصودة للطالب (حاضر - غائب - متأخر)
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_logs');
    }
};
