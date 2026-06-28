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
        // جدول الرسوم والمطالبات الشهرية
        Schema::create('student_monthly_fees', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي والسجل المالي الفرعي لكل عملية
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // يربط الحركة بالطالب المستحق عليه القسط المالي
            $table->string('academic_level', 50); // المرحلة الدراسية للطالب وقت المطالبة (لتحديد قيمة القسط تلقائياً)
            $table->string('billing_month', 20); // الشهر والسنة المستحق فيها القسط (مثل: 06-2026)
            $table->decimal('monthly_amount', 10, 2); // قيمة القسط الشهري الإجمالي المطلوب دفعه (مثال: 500.00)
            $table->decimal('paid_amount', 10, 2)->default(0.00); // إجمالي المبالغ التي تم سدادها وتراكمها فعلياً من قسط هذا الشهر
            $table->string('payment_method', 50)->nullable(); // طريقة آخر دفعة تمت (نقداً، تحويل بنكي، محفظة إلكترونية)
            $table->timestamp('payment_date')->nullable(); // تاريخ ووقت تسجيل آخر عملية دفع بدقة متناهية
            $table->text('notes')->nullable(); // مربع الملاحظات الإدارية والمالية الخاصة بالحركة المكتوبة بالفورم
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_monthly_fees');
    }
};
