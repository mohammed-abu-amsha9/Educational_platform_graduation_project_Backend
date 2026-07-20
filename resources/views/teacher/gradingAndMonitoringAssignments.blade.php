@extends('teacher.parent')
@section('title', 'تصحيح ومتابعة الواجبات')
@section('content')
    <div class="my-6 mx-auto space-y-6" dir="rtl">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-4 rounded-3xl shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600">
                    <i class="fa-solid fa-users-viewfinder text-base"></i>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        نظام إدارة وتصحيح الواجبات
                    </h2>
                    <p class="text-[11px] text-gray-400 font-medium">
                        قم برفع واجبات جديدة أو استعرض ملفات الـ PDF المصححة لكل طالب
                        على حدة
                    </p>
                </div>
            </div>

            <div class="flex bg-gray-100 dark:bg-slate-950 p-1 rounded-2xl w-full sm:w-auto">
                <a href="{{ route('assignments.index') }}"
                    class="text-xs font-bold px-4 py-2 rounded-xl cursor-pointer  text-gray-500 ">
                    <i class="fa-solid fa-plus-circle ml-1"></i> إنشاء واجب جديد
                </a>

                <a href="{{ route('gradingassignments') }}"
                    class="text-xs font-bold px-4 py-2 rounded-xl cursor-pointer  bg-white dark:bg-slate-900 text-teal-600 shadow-sm ">
                    <i class="fa-solid fa-graduation-cap ml-1"></i> تصحيح ومتابعة
                    الواجبات
                </a>
            </div>
        </div>

        <div id="trackSection" class="space-y-6">
            <div id="assignmentsListView"
                class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm space-y-4 block">
                <h3
                    class="text-xs font-black text-slate-800 dark:text-zinc-200 flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                    <span class="w-1.5 h-3 bg-teal-600 rounded-full"></span> 1. اختر
                    الواجب المراد استعراض تسليمات طلابه
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse text-xs">
                        <thead>
                            <tr
                                class="border-b border-gray-100 dark:border-slate-800 text-gray-700 dark:text-gray-400 font-bold">
                                <th class="pb-3 pl-4">اسم الواجب الدراسي</th>
                                <th class="pb-3 px-4">الصف</th>
                                <th class="pb-3 px-4">إجمالي التسليمات</th>
                                <th class="pb-3 pr-4 text-left">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60">
                            @foreach ($assignments as $assignment)
                                <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 ">
                                    <td class="py-4 pl-4 font-medium text-slate-800 dark:text-zinc-200">
                                        {{ $assignment->title }}
                                    </td>
                                    <td class="py-4 px-4 text-gray-400">
                                        {{ $assignment->grade->name ?? 'غير محدد' }}
                                    </td>
                                    <td class="py-4 px-4 text-teal-600 font-bold">
                                        {{ $assignment->submissions_count }} طلاب قاموا بالرفع
                                    </td>
                                    <td class="py-4 pr-4 text-left">
                                        <!-- تمرير ID الواجب للراوت -->
                                        <a href="{{ route('studentsListView', $assignment->id) }}"
                                            class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl font-bold cursor-pointer  shadow-sm">
                                            عرض تسليمات الطلاب
                                            <i class="fa-solid fa-arrow-left mr-1 text-[10px]"></i>
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
