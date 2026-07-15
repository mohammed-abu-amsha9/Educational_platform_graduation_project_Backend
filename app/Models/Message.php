<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    /** @use HasFactory<\Database\Factories\MessageFactory> */
    use HasFactory;
    // أضف هذه المصفوفة (أو عدلها إذا كانت موجودة)
    protected $fillable = [
        'chat_room_id',
        'sender_type',
        'message_text'
    ];
    /** الغرفة التي تنتمي إليها هذه الرسالة */
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class, 'chat_room_id');
    }
}
