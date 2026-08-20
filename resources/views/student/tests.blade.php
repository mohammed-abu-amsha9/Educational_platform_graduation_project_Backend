@extends('student.parent')
@section('title', 'الاختبارات')
@section('content')

    <div class="w-full space-y-6 text-xs text-right" dir="rtl" id="examsMainContainer">
        <div id="examsListView" class="space-y-6 block">
            <div class="flex items-center gap-2 pb-2 border-b border-gray-100 dark:border-slate-800">
                <span class="w-1.5 h-3 bg-teal-600 rounded-full animate-pulse"></span>
                <h3 class="font-black text-slate-800 dark:text-zinc-100 text-sm">
                    📝 منصة الاختبارات والتقييمات
                </h3>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- قسم الاختبارات المتاحة -->
                <div class="space-y-4">
                    <h4 class="font-black text-slate-800 dark:text-zinc-200 px-2 flex items-center gap-1.5">
                        <span>📝 الاختبارات المتاحة</span>
                    </h4>

                    @forelse($exams as $exam)
                        <div
                            class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 p-4 rounded-3xl shadow-sm hover:shadow-xl flex items-center justify-between gap-4 hover:border-teal-500/40">
                            <div class="space-y-2 flex-1 min-w-0">
                                <span
                                    class="bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-lg inline-flex items-center gap-1">
                                    <i class="fa-solid fa-cloud-arrow-up text-[8px]"></i> حقيقي
                                </span>

                                <!-- اسم الاختبار المخزن في الـ title -->
                                <h5 class="font-black text-slate-800 dark:text-zinc-100 text-xs truncate">
                                    {{ $exam->title }}
                                </h5>

                                <div class="flex items-center gap-3 text-gray-400 text-[10px] font-medium flex-wrap">
                                    <!-- عدد الأسئلة الحقيقي القادم من جدول الربط -->
                                    <span>
                                        <i class="fa-solid fa-list-check ml-0.5 text-teal-600"></i>
                                        <span>{{ $exam->questions->count() }}</span> أسئلة
                                    </span>

                                    <!-- مدة الاختبار الحقيقية -->
                                    <span>
                                        <i class="fa-solid fa-clock ml-0.5 text-amber-500"></i>
                                        {{ $exam->Exam_duration }} دقائق
                                    </span>
                                </div>
                            </div>

                            @php
                                $student_exam = $student_exams->get($exam->id);
                            @endphp

                            @if (!$student_exam || $student_exam->submit_time === 'لم يسلم بعد') {{-- اذا السجل التسليم مش موجود او الطالب ليم يسلم الاختبار بعد لا يسكر الامتحان  --}}
                                <a href="{{ route('studentExams.create', ['exam_id' => $exam->id]) }}"
                                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl cursor-pointer shadow-3xs shrink-0">
                                    بدء الاختبار
                                    <i class="fa-solid fa-chevron-left text-[9px] mr-1"></i>
                                </a>
                            @else
                                <button type="button" disabled
                                    class="bg-gray-400 text-white font-bold px-4 py-2 rounded-xl cursor-not-allowed opacity-60 shrink-0">
                                    تم تقديم الاختبار
                                    <i class="fa-solid fa-check text-[9px] mr-1"></i>
                                </button>
                            @endif
                        </div>
                    @empty
                        <!-- رسالة تظهر للطالب إذا لم يقم المعلمون بنشر أي اختبارات بعد -->
                        <div
                            class="bg-gray-50/50 dark:bg-slate-900/40 border border-dashed border-gray-200 dark:border-slate-800 p-8 rounded-3xl text-center text-gray-400">
                            لا توجد اختبارات متاحة لك حالياً.
                        </div>
                    @endforelse
                </div>


            </div>
        </div>
    </div>
@endsection
