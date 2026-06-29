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
        // جدول المستخدمين
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //رقم الهوية الشخصي الفريد للمستخدم كمفتاح دخول أساسي
            $table->string('name'); // الاسم المستخدم عند تسجيل الدخول للنظام
            $table->string('password', 255); // كلمة المرور السرية المخزنة بشكل تلقائي من بيانات الطالب  اللي هيا نفس قيمة id اللي رقم الهوية
            $table->string('role', 30); // فئة وصلاحية الحساب لتوجيه الواجهات (admin/student/teacher)
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
