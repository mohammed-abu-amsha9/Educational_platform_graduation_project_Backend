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
        // جدول الواجبات المنشورة
        Schema::create('assignments', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي والرقم التعريفي للواجب المنشور
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // المعلم صاحب المهمة والتكليف والمسؤول عن مراجعته وتصحيحه لاحقاً
            $table->string('academic_level_subject', 150); // تحديد وحفظ المادة والصف الدراسي الموجه له الواجب الدراسي
            $table->string('title', 200); // عنوان الواجب الرئيسي (مثل: واجب إعراب الجملة الفعلية والأفعال الخمس)
            $table->dateTime('due_date'); // آخر موعد وتاريخ محدد وصارم متاح أمام الطالب لإرسال حل الواجب
            $table->text('description'); // التوصيف والتوجيه النصي التفصيلي لمضمون وحل الواجب المطلوبة
            $table->string('attachment_url', 255)->nullable(); // رابط أو مسار ملف الأسئلة الاختياري المرفق مع الواجب من المعلم
            $table->integer('total_grade'); // درجة الواجب الإجمالية (مثلاً: الواجب من 10 درجات أو 20 درجة)
            $table->timestamps(); // سينتج عنها created_at وهو وقت إطلاق ونشر المهمة على لوحة تحكم حسابات الطلاب
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
