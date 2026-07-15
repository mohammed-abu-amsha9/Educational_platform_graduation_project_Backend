@extends('student.parent')
@section('title', 'الدردشة')
@section('content')
    <div class="container mx-auto p-4">
        <!-- هنا نقوم باستدعاء المكون، وسيقوم هو بكل العمل -->
        <livewire:chat-box userType="student" />
    </div>
@endsection
