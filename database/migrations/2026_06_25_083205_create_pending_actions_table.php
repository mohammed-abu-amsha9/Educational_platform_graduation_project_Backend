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
        // جدول العمليات المعلقة أوفلاين
        Schema::create('pending_actions', function (Blueprint $table) {
            $table->id(); // المعرف الفريد لكل عملية مخزنة محلياً بجهاز الطالب بانتظار المزامنة
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // رقم كود الطالب الذي أجرى تلك الحركة والإنترنت مقطوع عن جهازه
            $table->string('action_type', 50); // نوع الإجراء المدخر محلياً لتفكيكه وفرزه (مثل: submit_exam أو send_message)
            $table->text('payload_json'); // حزمة البيانات المدخرة بصيغة نصية مكثفة JSON لرفعها فوراً لخوادم السيرفر الرئيسي
            $table->timestamp('timestamp')->useCurrent(); // تاريخ ووقت تسجيل الحركة محلياً لفرز وترتيب واجهة طابور المزامنة المنتظر
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_actions');
    }
};
