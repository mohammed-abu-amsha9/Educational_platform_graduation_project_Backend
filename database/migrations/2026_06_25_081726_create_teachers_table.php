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
        // جدول المعلمين
        Schema::create('teachers', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي والمعرف الفريد للمعلم
            $table->string('full_name', 150); // الاسم الكامل للأستاذ الظاهر في واجهات المناهج
            $table->string('teacher_code', 50)->unique(); // الرقم الوظيفي التسلسلي الخاص بالمعلم
            $table->string('phone_number', 20); // رقم هاتف المعلم للتواصل الإداري والتنسيق
            $table->string('subject', 100); // المادة الأساسية الموكلة للأستاذ لتدريسها
            $table->foreignId('role_id')->constrained('role_permissions'); // يربط المعلم بجدول الصلاحيات والأدوار المسموحة له
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
