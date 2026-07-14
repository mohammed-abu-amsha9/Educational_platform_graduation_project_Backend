@extends('student.parent')
@section('title', 'المواد')
@section('content')

    <div class="w-full space-y-6 text-xs" dir="rtl">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($contents as $content)
                <div id="subject-teacher-card-{{ $content->id }}"
                    class="bg-white dark:bg-slate-900 border-2 border-teal-500 p-5 rounded-3xl shadow-xs flex flex-col justify-between space-y-4">

                    <div class="flex items-start justify-between gap-3">
                        <div class="space-y-1">
                            <span
                                class="bg-teal-50 dark:bg-teal-950 text-teal-600 text-[10px] font-black px-2 py-0.5 rounded">إلزامي</span>

                            <!-- عرض اسم المادة ديناميكياً -->
                            <h4 class="font-black text-slate-800 dark:text-zinc-100 text-xs pt-1">
                                {{ 'مادة ' . $content->subject_name }}
                            </h4>

                            <!-- عرض اسم المعلم المشرف على هذه المادة بالذات -->
                            <p class="text-[10px] text-gray-400 font-medium">
                                المعلم المشرف: {{ $content->teacher_name }}
                            </p>
                        </div>

                        <div
                            class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 shrink-0">
                            <i class="fa-solid fa-book-open text-base"></i>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-100 dark:border-slate-800/60 flex items-center justify-between">
                        <!-- عرض عدد الدروس التي نشرها هذا المعلم بالتحديد في هذه المادة -->
                        <span class="text-gray-400 font-bold text-[11px]">
                            <i class="fa-solid fa-circle-play ml-0.5 text-teal-600"></i>
                            {{ $content->lessons_count }} محتوى تعليمي نشط
                        </span>

                        <!-- زر فتح المادة وتمرير معرف المادة ومعرف المعلم معاً للصفحة التالية ليعرض دروس هذا المعلم فقط -->
                        <!-- تمرير الـ subject_id كمعامل أساسي (مكان الـ materialContent)، والـ teacher_id كـ Query String إضافي -->
                        <a href="{{ route('materialContents.show', ['materialContent' => $content->subject_id, 'teacher_id' => $content->teacher_id]) }}"
                            class="stud-subject-btn bg-teal-600 text-white font-bold px-3 py-1.5 rounded-xl cursor-pointer shadow-xs flex items-center gap-1 text-[11px]">
                            <span>فتح</span>
                            <i class="fa-solid fa-folder-open text-[10px]"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
