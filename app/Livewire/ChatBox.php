<?php

namespace App\Livewire;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\student;
use App\Models\teacher;
use Livewire\Component;

class ChatBox extends Component
{
    public $messageText = '';
    public $roomId = null;
    public $userType = 'student'; // 'student' أو 'teacher'

    public function selectRoom($id)
    {
        $this->roomId = $id;
    }

    public function sendMessage()
    {
        if (!$this->roomId || empty($this->messageText)) return;

        Message::create([
            'chat_room_id' => $this->roomId,
            'sender_type'  => $this->userType,
            'message_text' => $this->messageText,
        ]);
        $this->messageText = '';
    }

    public function render()
    {
        // جلب البيانات بناءً على النوع
        if ($this->userType == 'teacher') {
            // إذا كان معلماً، نجلب الطلاب
            $usersList = \App\Models\Student::all();
        } else {
            // إذا كان طالباً، نجلب المعلمين
            $student = \App\Models\Student::find($this->studentId);
            $usersList = \App\Models\Teacher::whereHas('grades', function ($query) use ($student) {
                $query->where('grade_id', $student->grade_id);
            })->get();
        }

        $messages = $this->roomId ? \App\Models\Message::where('chat_room_id', $this->roomId)->orderBy('created_at', 'asc')->get() : [];

        // نمرر المتغير الجديد $usersList بدلاً من $teachers
        return view('livewire.chat-box', compact('usersList', 'messages'));
    }
    public $recipient; // هذا المتغير سيحمل بيانات الشخص الذي تحادثه (معلم أو طالب)

    public function selectPerson($personId, $id)
    {
        // عند اختيار الشخص، نجلب بياناته ونخزنها في $recipient
        $this->recipient = ($this->userType == 'teacher')
            ? \App\Models\Student::find($id)
            : \App\Models\Teacher::find($id);
        // عند الضغط، ننشئ الغرفة بناءً على النوع
        if ($this->userType == 'teacher') {
            $room = \App\Models\ChatRoom::firstOrCreate([
                'student_id' => $personId,
                'teacher_id' => $this->teacherId, // تأكد من تعريف teacherId للمعلم
            ]);
        } else {
            $room = \App\Models\ChatRoom::firstOrCreate([
                'student_id' => $this->studentId,
                'teacher_id' => $personId,
            ]);
        }
        $this->roomId = $room->id;
    }
    public $studentId = 1; // الرقم الثابت للطالب حالياً

    public function selectTeacher($teacherId)
    {
        // إنشاء الغرفة باستخدام الـ ID الثابت
        $room = \App\Models\ChatRoom::firstOrCreate([
            'student_id' => $this->studentId,
            'teacher_id' => $teacherId,
        ]);

        $this->roomId = $room->id;
    }
}
