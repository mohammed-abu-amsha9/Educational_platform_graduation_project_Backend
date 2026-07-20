<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chat_room extends Model
{
    /** @use HasFactory<\Database\Factories\ChatRoomFactory> */
    use HasFactory;
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function student()
    {
        return $this->belongsTo(student::class); // أو User حسب جدولك
    }
    public function teacher()
    {
        return $this->belongsTo(teacher::class);
    }
}
