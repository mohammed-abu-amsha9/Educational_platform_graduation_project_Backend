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
        // جدول شعب الدروس
        Schema::create('lesson_sections', function (Blueprint $table) {
            $table->id(); // المعرف الفريد لحركة الربط للشعبة
            $table->foreignId('lesson_id')->constrained()->onDelete('cascade'); // يرتبط بالدرس المستهدف نشره لعدة شعب
            $table->string('academic_level', 50); // الصف الأكاديمي المسند تدريسه للمعلم
            $table->string('section_name', 20); // اسم الشعبة المخول لطلابها مشاهدة الدرس (مثل: شعبة أ)
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_sections');
    }
};
