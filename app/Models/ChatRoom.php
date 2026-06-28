<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    /** @use HasFactory<\Database\Factories\ChatRoomFactory> */
    use HasFactory;

    // واحد لمتعدد. الغرفة الواحدة تحتوي على رسائل كثيرة.
    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_room_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
