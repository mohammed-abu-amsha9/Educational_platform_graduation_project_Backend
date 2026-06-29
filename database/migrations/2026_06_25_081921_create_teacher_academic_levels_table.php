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
        //جدول صفوف المعلمين
        Schema::create('teacher_academic_levels', function (Blueprint $table) {
            $table->id(); // المعرف الفريد لسجل الربط
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // يرتبط بالمعلم المعني بالصف الدراسي
            $table->string('academic_level', 50); // الصف الأكاديمي المسند تدريسه للمعلم
            $table->string('section_name', 50); // الشعبة، مثل: شعبة (أ)
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_academic_levels');
    }
};
