@extends('teacher.parent')
@section('title', 'نظرة عامة')
@section('content')
    <div class="w-full space-y-6 my-6 text-xs" dir="rtl">
        <div class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-3 gap-4">
            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">إجمالي الطلاب</span>
                        <span class="text-sm text-teal-600 dark:text-teal-400 font-semibold">{{ $studentCount }} طالب</span>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 shadow-sm">
                        <i class="fa-solid fa-users text-lg"></i>
                    </div>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">واجبات بانتظار التصحيح</span>
                        <p class="text-xl font-black text-rose-500">
                            {{ $assignmentUncorrection->count() }}
                            <span class="text-[13px] text-slate-600 dark:text-gray-400 font-normal">ملفات</span>
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-955 flex items-center justify-center text-rose-500 shadow-sm">
                        <i class="fa-solid fa-clock-rotate-left text-lg"></i>
                    </div>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">الاختبارات المنشورة</span>
                        <p class="text-xl font-black text-indigo-500">
                            {{ $examPublished->count() }}
                            <span class="text-[13px] text-slate-600 dark:text-gray-400 font-normal">واجبات</span>
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-indigo-500 shadow-sm">
                        <i class="fa-solid fa-book text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-3 bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm flex flex-col justify-between space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                            🏫 الصفوف الدراسية الخاصة بي
                        </h3>
                        <p class="text-[10px] text-slate-500 dark:text-gray-400 font-medium">
                            قائمة بالفصول التي تقوم بتدريسها حالياً وإحصاء سريع لعدد
                            الطلاب المضافين
                        </p>
                    </div>
                    <span
                        class="bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 font-bold px-2.5 py-1 rounded-full text-[10px]">
                        إجمالي: {{ $gradesTeacher->grades->count() }} فصول
                    </span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 pt-2">
                    @foreach ($gradesTeacher->grades as $index => $grade)
                        <div
                            class="p-4 border border-gray-100 dark:border-slate-800/80 bg-gray-50/30 dark:bg-slate-950/20 rounded-2xl flex flex-col justify-between space-y-3 hover:border-teal-500 ">
                            <div class="space-y-1">
                                <div
                                    class="w-7 h-7 rounded-lg bg-teal-600/10 text-teal-600 flex items-center justify-center font-black">
                                    {{ $index + 1 }}
                                </div>
                                <h4 class="font-bold text-slate-800 dark:text-zinc-200 text-xs pt-1">
                                    {{ $grade->name }}
                                    @foreach ($grade->sections as $section)
                                        - ({{ $section->name }})
                                    @endforeach
                                </h4>
                                @foreach ($grade->subjects as $subject)
                                    <p class="text-[10px] text-slate-600 dark:text-gray-400">
                                        {{ $subject->name }}
                                    </p>
                                @endforeach
                            </div>
                            <div
                                class="pt-2 border-t border-gray-100 dark:border-slate-800/40 flex items-center justify-between">
                                <span class="text-slate-600 dark:text-gray-400 text-[10px]">عدد الطلاب:</span>
                                <span
                                    class="font-black text-slate-800 dark:text-zinc-100 text-xs bg-white dark:bg-slate-900 px-2 py-0.5 rounded-md border border-gray-200 dark:border-slate-800">{{ $grade->students->count() }}
                                    طالباً</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
