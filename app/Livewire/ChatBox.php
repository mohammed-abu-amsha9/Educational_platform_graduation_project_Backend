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
    public $teacherId; // 'student' أو 'teacher'
    public $studentId; // 'student' أو 'teacher'

    public function mount()
    {
        // تحديد نوع المستخدم بناءً على role_id في جدول users
        $user = auth()->user();

        if ($user->role_id == 2) { // المعلم
            $this->userType = 'teacher';
            $this->teacherId = \App\Models\Teacher::where('id', $user->id)->value('id');
        } else { // الطالب
            $this->userType = 'student';
            $this->studentId = \App\Models\Student::where('id', $user->id)->value('id');
        }
    }
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
        // 1. عرّف المتغير بقيمة افتراضية دائماً
        $usersList = [];
        $messages = [];

        // 2. تعبئة البيانات بناءً على النوع
        if ($this->userType == 'teacher') {
            $usersList = \App\Models\Student::all();
        } else {
            // تأكد من جلب الطالب بناءً على المستخدم الحالي وليس قيمة ثابتة
            $student = \App\Models\Student::where('id', auth()->id())->first();
            if ($student) {
                $usersList = \App\Models\Teacher::whereHas('grades', function ($query) use ($student) {
                    $query->where('grade_id', $student->grade_id);
                })->get();
            }
        }

        // 3. جلب الرسائل
        if ($this->roomId) {
            $messages = \App\Models\Message::where('chat_room_id', $this->roomId)->orderBy('created_at', 'asc')->get();
        }

        // 4. تمرير المتغيرات باستخدام compact
        return view('livewire.chat-box', compact('usersList', 'messages'));
    }
    public $recipient; // هذا المتغير سيحمل بيانات الشخص الذي تحادثه (معلم أو طالب)

    public function selectPerson($personId) // استخدم هذه الدالة للمعلم والطالب
    {
        // 1. تحديث المتغير $recipient ليتم عرضه في الواجهة
        $this->recipient = ($this->userType == 'teacher')
            ? \App\Models\Student::find($personId)
            : \App\Models\Teacher::find($personId);
        // 1. تحديد ID المستخدم الحالي (سواء كان معلماً أو طالباً)
        $currentUserId = auth()->id();


        // 2. إعداد مصفوفة البحث عن الغرفة
        $data = [];

        if ($this->userType == 'teacher') {
            // إذا كان معلماً: الـ personId هو الطالب، والـ teacherId هو المعلم الحالي
            $teacherId = \App\Models\Teacher::where('id', $currentUserId)->value('id');
            $data = [
                'student_id' => $personId, // القادم من الزر
                'teacher_id' => $teacherId
            ];
        } else {
            // إذا كان طالباً: الـ personId هو المعلم، والـ studentId هو الطالب الحالي
            $studentId = \App\Models\Student::where('id', $currentUserId)->value('id');
            $data = [
                'student_id' => $studentId,
                'teacher_id' => $personId
            ];
        }

        // 3. الإنشاء
        $room = \App\Models\ChatRoom::firstOrCreate($data);
        $this->roomId = $room->id;
    }

}
