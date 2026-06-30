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
        // جدول بيانات الطلاب
        Schema::create('students', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي والمعرف الفريد لكل طالب
            $table->string('full_name', 150); // الاسم الكامل للطالب المستخدم في القوائم والشهادات
            $table->string('student_code', 50)->unique(); // الرقم التسلسلي الفريد والخاص بالطالب داخل المنصة
            $table->string('academic_level', 50); // الصف أو المستوى الدراسي الحالي للطالب
            $table->string('section_name'); // الشعبة
            $table->string('total_paid_amount'); // اجمالي الرسوم
            $table->string('parent_id',20); // رقم هوية ولي الأمر
            $table->string('parent_phone', 20); // رقم التواصل الأساسي لولي الأمر
            $table->string('parent_backup_phone', 20)->nullable(); // رقم الهاتف الاحتياطي لولي الأمر في حالات الطوارئ
            $table->string('account_status', 20)->default('active'); // حالة حساب الطالب من وقت ما يباد انشاء ملف الطالب الحالة تلقائيا نشط
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
