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
        // جدول تسليمات الواجبات
        Schema::create('assignment_submissions', function (Blueprint $table) {
            $table->id(); // المفتاح الأساسي لسجل حركة تسليم ملف حل الطالب
            $table->foreignId('assignment_id')->constrained()->onDelete('cascade'); // يربط حركة التسليم بالواجب الأصلي المطلوب تسليمه
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // يرتبط بالطالب الذي قام بحل ورفع ملف الواجب للمنصة
            $table->string('submitted_file_url', 255); // رابط ومسار ملف الحل المرفوع من الطالب (كراسة إجابة PDF أو صورة)
            $table->integer('grade')->nullable(); // الدرجة والعلامة المستحقة التي يضعها المعلم يدوياً بعد مراجعة ملف الحل
            $table->string('status', 50); // حالة تصحيح التسليم الحالي لمتابعة الواجهات (لم يتم التصحيح، تم التصحيح)
            $table->timestamp('submitted_at')->useCurrent(); // الوقت والتاريخ الدقيق والآلي لقيام الطالب بضغط زر إرسال للحل
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_submissions');
    }
};
