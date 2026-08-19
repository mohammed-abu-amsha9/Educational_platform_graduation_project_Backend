@extends('teacher.parent')
@section('title', 'تصحيح الواجب')
@section('content')
    <!-- قسم لوحة التقييم (تم تحويله لصفحة عادية) -->
    <div class="mt-6 bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 rounded-3xl shadow-sm overflow-hidden text-right text-xs"
        dir="rtl">

        <!-- رأس الصفحة -->
        <div
            class="bg-gray-50 dark:bg-slate-950/60 px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                <h3 class="text-xs font-black text-slate-800 dark:text-zinc-100">
                    لوحة مراجعة وتقييم إجابة الطالب
                </h3>
            </div>
        </div>

        <!-- نموذج التقييم -->
        <form action="{{ route('assignmentSubmissions.update', $submission->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')
            <!-- الجزء الأول: ملف الطالب -->
            <div class="space-y-2">
                <h4 class="font-bold text-gray-700 dark:text-slate-400">
                    1. مستند حل الطالب المرفوع:
                </h4>
                <div
                    class="p-4 border border-gray-200 dark:border-slate-800 rounded-2xl bg-gray-50 dark:bg-slate-950 flex flex-col sm:flex-row justify-between items-center gap-3">
                    <span class="text-slate-800 dark:text-zinc-100 font-medium">
                        <i class="fa-solid fa-file-pdf text-rose-500 text-base ml-1"></i>
                        {{ basename($submission->submitted_file_url) }}
                    </span>
                    <a href="{{ asset('storage/' . $submission->submitted_file_url) }}" target="_blank"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl text-center transition-colors">
                        فتح وتدقيق ملف الطالب
                        <i class="fa-solid fa-external-link mr-1 text-[10px]"></i>
                    </a>
                </div>
            </div>

            <!-- الجزء الثاني: التقييم -->
            <div class="space-y-2">
                <h4 class="font-bold text-gray-700 dark:text-slate-400">
                    2. رصد التقييم والدرجة المستحقة:
                </h4>
                <div
                    class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-teal-50/30 dark:bg-slate-950/40 rounded-2xl border border-teal-100/60 dark:border-slate-800">
                    <div>
                        <label class="block font-bold text-gray-600 dark:text-slate-400 mb-1">الدرجة النهائية *</label>
                        <div class="relative flex items-center">
                            <input type="number" name="mark" required min="0" max="10" placeholder="مثال: 9"
                                class="w-full border bg-white dark:bg-slate-900 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-center font-bold outline-none focus:border-teal-500" />
                            <span class="absolute left-3 font-bold text-gray-400">/
                                {{ $submission->assignment->total_mark }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- أزرار الإجراءات -->
            <div class="flex justify-end gap-2 pt-4 border-t border-gray-100 dark:border-slate-800">
                <button type="submit"
                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2 rounded-xl shadow-md cursor-pointer">
                    حفظ واعتماد التقييم
                </button>
            </div>
        </form>
    </div>
@endsection
