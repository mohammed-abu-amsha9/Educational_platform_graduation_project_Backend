<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;

    public function permistions()
    {
        // نحدد اسم الجدول الوسيط والـ Foreign Key بسبب التسمية الخاصة بك
        return $this->belongsToMany(permistion::class, 'permistion_roles', 'role_id', 'permistion_id');
    }

    /**
     * جلب كافة المعلمين المرتبطين بهذا الدور
     */
    public function teachers()
    {
        return $this->hasMany(teacher::class, 'role_id');
    }
}
