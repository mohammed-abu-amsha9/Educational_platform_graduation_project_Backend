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
        // جدول الإعلانات - الإشعارات
        Schema::create('announcements', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي السحابي لكل إشعار وتنبيه منشور للمستخدمين
            // هذا السطر يختصر الحقلين (notifiable_id و notifiable_type) تلقائياً في لارفل
            $table->morphs('notifiable');
            $table->string('title', 150); // العنوان التنبيهي والمختصر الموجه (مثل: تم رصد علامة اختبار الرياضيات)
            $table->text('content'); // النص والمضمون الكامل والشارح للإشعار المنشور على شاشة التنبيهات
            $table->string('action_url', 255); // رابط انتقال سريع مدمج (Deep Link) ينقل المستخدم للشاشة المعنية عند النقر
            $table->boolean('is_read')->default(false); // حقل منطقي لتحديد قراءة التنبيه لإخفاء علامة النقطة التنبيهية الحمراء
            $table->timestamps(); // سينتج عنها created_at وقت وتاريخ إصدار وبث الإعلان والتنبيه السحابي للمستخدم
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
