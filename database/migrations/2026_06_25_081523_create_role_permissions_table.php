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
        // جدول الأدوار والصلاحيات
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي لتعريف الدور الصلاحياتي
            $table->string('role_name', 50); // اسم الدور الممنوح (معلم، مشرف، مدير، إلخ)
            $table->boolean('can_manage_attendance'); // مؤشر منح أو حجب صلاحية أخذ الحضور والغياب
            $table->boolean('can_upload_files'); // صلاحية رفع ملفات المناهج والمحاضرات للطلاب
            $table->boolean('can_create_exams'); // صلاحية إنشاء وإعداد امتحانات إلكترونية من البنك
            $table->boolean('can_edit_grades'); // صلاحية رصد وتعديل علامات ودرجات الطلاب
            $table->boolean('can_reply_messages'); // صلاحية فتح غرف الشات والرد على رسائل أولياء الأمور
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
