<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatRoom extends Model
{
    /** @use HasFactory<\Database\Factories\ChatRoomFactory> */
    use HasFactory, SoftDeletes;

    /** المعلم المشترك في هذه المحادثة */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    /** الطالب المشترك في هذه المحادثة */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /** كافة الرسائل المتبادلة داخل هذه الغرفة */
    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_room_id');
    }
}
