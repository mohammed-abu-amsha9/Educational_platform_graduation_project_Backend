<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    /** @use HasFactory<\Database\Factories\RolePermissionFactory> */
    use HasFactory, SoftDeletes;

    // واحد لمتعدد (One-to-Many). الدور الواحد يمتلكه العديد من المعلمين
    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'role_id');
    }
}
