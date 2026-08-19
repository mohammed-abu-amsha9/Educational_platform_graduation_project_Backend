@extends('teacher.parent')
@section('title', 'عرض الواجبات')
@section('content')
    <div class="my-6 mx-auto space-y-6" dir="rtl">
        <div id="trackSection" class="space-y-6">
            <div id="studentsListView"
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-4 ">
                <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-slate-800">
                    <a href="{{ route('gradingassignments') }}"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-200 font-bold cursor-pointer">
                        <i class="fa-solid fa-arrow-right"></i> عودة للواجبات
                    </a>

                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse text-xs">
                        <thead>
                            <tr
                                class="border-b border-gray-100 dark:border-slate-800 text-gray-700 dark:text-gray-500 font-bold">
                                <th class="pb-3 pl-4">اسم الطالب</th>
                                <th class="pb-3 px-4">الملف المرفوع (PDF)</th>
                                <th class="pb-3 px-4">حالة التقييم</th>
                                <th class="pb-3 pr-4 text-left">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60">
                            @foreach ($submissions as $submission)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 transition-colors">
                                    <td class="py-4 pl-4 font-bold text-slate-800 dark:text-zinc-100">
                                        {{ $submission->student->full_name }}
                                    </td>
                                    <td class="py-4 px-4 text-teal-600 font-medium">
                                        <a {{ asset('storage/' . $submission->submitted_file_url) }}" target="_blank"
                                            class="hover:underline flex items-center gap-1"><i
                                                class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                                            {{ basename($submission->submitted_file_url) }}</a>
                                    </td>
                                    <td class="py-4 px-4">
                                        @if ($submission->status === 'correction')
                                            <span
                                                class="text-emerald-500 font-bold bg-emerald-50 dark:bg-emerald-950/30 px-2 py-0.5 rounded">
                                                مصحح
                                            </span>
                                        @else
                                            <span
                                                class="text-rose-500 font-bold bg-rose-50 dark:bg-rose-950/30 px-2 py-0.5 rounded">
                                                غير مصحح
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 pr-4 text-left">
                                        <a href="{{ route('reviewAndCorrection', $submission->id) }}"
                                            class="bg-teal-600 text-white  px-3 py-1.5 rounded-lg font-bold cursor-pointer">
                                            فحص وتصحيح
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
