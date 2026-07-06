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
        // جدول صفوف المعلمين 
        Schema::create('grade_teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->constrained()->onDelete('cascade'); // يرتبط بالمعلم المعني بالصف الدراسي
            $table->foreignId('grade_id')->constrained()->onDelete('cascade'); // يرتبط بالمعلم المعني بالصف الدراسي
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_teachers');
    }
};
