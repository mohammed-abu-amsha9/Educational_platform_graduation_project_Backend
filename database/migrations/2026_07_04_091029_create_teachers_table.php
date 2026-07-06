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
            $table->id();
            $table->string('full_name', 150); // الاسم الكامل للأستاذ الظاهر في واجهات المناهج
            $table->string('teacher_code', 50)->unique(); // الرقم الوظيفي التسلسلي الخاص بالمعلم
            $table->string('phone_number', 20); // رقم هاتف المعلم للتواصل الإداري والتنسيق
            $table->string('account_status', 20)->default('active'); // حالة حساب الطالب من وقت ما يباد انشاء ملف الطالب الحالة تلقائيا نشط
            $table->foreignId('role_id')->constrained(); // يربط المعلم بجدول الصلاحيات والأدوار المسموحة له
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
