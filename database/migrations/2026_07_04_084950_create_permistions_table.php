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
        // جدول الصلاحيات
        Schema::create('permistions', function (Blueprint $table) {
            $table->id();
            $table->string('permistion_name', 50); // اسم الصلاحية  (تسجيل حضور، رصد علامات ،إلخ)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permistions');
    }
};
