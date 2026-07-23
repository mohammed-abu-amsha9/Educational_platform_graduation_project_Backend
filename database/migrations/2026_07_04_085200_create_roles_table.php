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
        // جدول الادوار
        Schema::create('roles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('role_name', 50); // اسم الدور الممنوح (معلم، مشرف، مدير، إلخ)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
