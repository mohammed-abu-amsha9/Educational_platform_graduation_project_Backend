@extends('teacher.parent')
@section('title', 'الاختبارات')
@section('content')
    <div class="container mx-auto px-4 py-8" dir="rtl">

        <!-- رأس الصفحة والترحيب -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-xl font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                    <i class="fa-solid fa-file-signature text-teal-600"></i>
                    لوحة تحكم الاختبارات
                </h1>
                <p class="text-xs text-slate-500 dark:text-gray-400 font-medium mt-1">
                    إدارة واختبارات الطلاب، متابعة الإحصائيات الحية، وتفعيل النشر بضغطة زر.
                </p>
            </div>
        </div>

        <!-- رسائل التنبيه والنجاح -->
        @if (session('success'))
            <div
                class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 dark:bg-emerald-950/20 dark:border-emerald-900/60 dark:text-emerald-400 text-xs font-bold flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-sm"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- بطاقات إحصائية سريعة -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-gray-400 dark:text-slate-500 block">إجمالي الاختبارات</span>
                    <span class="text-xl font-black text-slate-800 dark:text-zinc-100">{{ $exams->count() }}</span>
                </div>
                <div
                    class="w-10 h-10 rounded-2xl bg-gray-50 dark:bg-slate-950 flex items-center justify-center text-slate-600 dark:text-zinc-400">
                    <i class="fa-solid fa-folder-open text-base"></i>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-gray-400 dark:text-slate-500 block">الاختبارات المنشورة</span>
                    <span
                        class="text-xl font-black text-emerald-600">{{ $exams->where('status', 'Published')->count() }}</span>
                </div>
                <div
                    class="w-10 h-10 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600">
                    <i class="fa-solid fa-circle-check text-base"></i>
                </div>
            </div>
            <div
                class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-[10px] font-bold text-gray-400 dark:text-slate-500 block">مسودات غير منشورة</span>
                    <span
                        class="text-xl font-black text-amber-600">{{ $exams->where('status', 'Unpublished')->count() }}</span>
                </div>
                <div
                    class="w-10 h-10 rounded-2xl bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center text-amber-600">
                    <i class="fa-solid fa-clock text-base"></i>
                </div>
            </div>
        </div>

        <!-- جدول عرض الاختبارات المطور -->
        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800/80 rounded-3xl shadow-sm overflow-hidden ">
            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50/70 dark:bg-slate-950/40 border-b border-gray-100 dark:border-slate-800 text-gray-500 dark:text-slate-400 font-bold">
                            <th class="p-4 font-black">معلومات الاختبار</th>
                            <th class="p-4 font-black">المعايير والوقت</th>
                            <th class="p-4 font-black text-center">تفاصيل الدرجات</th>
                            <th class="p-4 font-black text-center">حالة النشر</th>
                            <th class="p-4 font-black text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-800 text-slate-700 dark:text-zinc-300">
                        @forelse($exams as $exam)
                            <tr class="hover:bg-gray-50/40 dark:hover:bg-slate-950/10 ">
                                <!-- معلومات الاختبار -->
                                <td class="p-4">
                                    <div class="flex flex-col gap-1">
                                        <span class="font-bold text-slate-800 dark:text-zinc-200 text-sm">
                                            {{ $exam->title }} - {{ $exam->grade->name }}
                                        </span>
                                        <span class="text-[10px] text-gray-400 dark:text-slate-500 font-medium">
                                            تاريخ الإنشاء: {{ $exam->created_at->format('Y-m-d') }}
                                        </span>
                                    </div>
                                </td>

                                <!-- المعايير والوقت -->
                                <td class="p-4">
                                    <div class="flex flex-col gap-1 font-medium">
                                        <span class="text-slate-600 dark:text-zinc-400 flex items-center gap-1">
                                            <i class="fa-regular fa-clock text-teal-600"></i> المدة:
                                            {{ $exam->Exam_duration }} دقيقة
                                        </span>
                                        <span class="text-[10px] text-gray-400 dark:text-slate-500 flex items-center gap-1">
                                            <i class="fa-regular fa-calendar text-gray-400"></i> متاح من:
                                            {{ $exam->Start_time }} إلى: {{ $exam->End_Time }}
                                        </span>
                                    </div>
                                </td>

                                <!-- الدرجات والأسئلة -->
                                <td class="p-4 text-center">
                                    <div class="flex flex-col gap-0.5">
                                        <span
                                            class="font-bold text-slate-800 dark:text-zinc-200">{{ $exam->total_questions }}
                                            أسئلة</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-gray-100 dark:bg-slate-800 text-[10px] font-bold text-gray-600 dark:text-zinc-400 inline-block mx-auto">
                                            الدرجة الكلية: {{ $exam->Total_score }}
                                        </span>
                                    </div>
                                </td>

                                <!-- حالة النشر والتحويل الفوري -->
                                <td class="p-4 text-center align-middle">
                                    @if ($exam->status === 'Published')
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400 font-bold text-[11px]">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            منشور ونشط
                                        </span>
                                    @else
                                        <!-- فورم مخفي لتحديث الحالة عند الضغط على زر النشر -->
                                        <form action="{{ route('exams.update', $exam->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="bg-amber-500 hover:bg-amber-600 text-white-700 font-bold text-[11px] px-3 py-1.5 rounded-xl  shadow-md shadow-amber-600/10 cursor-pointer flex items-center gap-1 mx-auto group">
                                                <i class="fa-solid fa-bullhorn group-hover:animate-bounce"></i>
                                                <span>نشر الآن</span>
                                            </button>
                                        </form>
                                    @endif
                                </td>

                                <!-- أزرار الإجراءات (Actions) -->
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 rounded-xl border border-gray-200 dark:border-slate-800 flex items-center justify-center  text-rose-600 dark:hover:text-rose-400 hover:border-rose-300  shadow-sm cursor-pointer"
                                                title="حذف الاختبار">
                                                <i class="fa-regular fa-trash-can text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400 dark:text-slate-500">
                                    <div class="flex flex-col items-center justify-center gap-2 py-6">
                                        <i class="fa-solid fa-inbox text-3xl text-gray-300 dark:text-slate-800"></i>
                                        <p class="font-bold">لا يوجد أي اختبارات منشأة حالياً.</p>
                                        <p class="text-[10px] text-gray-400">قم بالضغط على زر "توليد اختبار جديد" بالأعلى
                                            للبدء فوراً.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
