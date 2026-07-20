<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permistion extends Model
{
    /** @use HasFactory<\Database\Factories\PermistionFactory> */
    use HasFactory;

    public function roles()
    {
        return $this->belongsToMany(role::class, 'permistion_roles', 'permistion_id', 'role_id');
    }
}
