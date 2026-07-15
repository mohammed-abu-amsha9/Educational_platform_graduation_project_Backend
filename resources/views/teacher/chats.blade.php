@extends('teacher.parent')
@section('title', 'صندوق المراسلة')
@section('content')
    <div class="container mx-auto p-4">
        <!-- هنا نقوم باستدعاء المكون، وسيقوم هو بكل العمل -->
        <livewire:chat-box userType="teacher" />
    </div>
@endsection
