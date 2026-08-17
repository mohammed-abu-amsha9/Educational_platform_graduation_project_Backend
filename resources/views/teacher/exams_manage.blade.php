@extends('teacher.parent')
@section('title', 'رصد الاختبارات')
@section('content')
    <div class="my-6 mx-auto space-y-6" dir="rtl">
        <div id="setupSection"
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-6 rounded-3xl shadow-sm space-y-6 ">
            <div class="flex items-center gap-2 border-b border-gray-100 dark:border-slate-800 pb-4">
                <div
                    class="w-8 h-8 rounded-xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600">
                    <i class="fa-solid fa-robot text-sm"></i>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        رصد وتدقيق الدرجات التلقائي
                    </h2>
                    <p class="text-[11px] text-slate-700 dark:text-gray-400 font-medium">
                        يتم تصحيح الاختبارات الإلكترونية ورصدها تلقائياً، يمكنك مراجعة وتدقيق الدرجات بمجرد اختيار المادة
                        والصف
                    </p>
                </div>

            </div>
            <button onclick="printSection('printable-score-sheet')"
                class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded-xl text-xs flex justify-start items-center gap-2">
                <i class="fa-solid fa-print"></i>
                طباعة الكشف فقط
            </button>
            <!-- 1. نموذج الفلتر المعتمد على لارافيل بالكامل (GET) -->
            <form action="{{ url()->current() }}" method="GET"
                class="bg-white dark:bg-slate-900  border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-6 rounded-3xl shadow-sm space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end text-sm">

                    <div class="sm:col-span-3">
                        <label class="block font-bold text-slate-800 dark:text-zinc-100 mb-1">المادة والصف الدراسي</label>
                        <select name="section_id"
                            class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl p-2.5 text-sm">
                            <option value="">-- اختر الصف والشعبة --</option>

                            @foreach ($currentTeacher->grades->unique('id') as $grade)
                                @if ($grade->sections->isNotEmpty())
                                    <!-- إذا كان الصف يحتوي على شعب في النظام -->
                                    @foreach ($grade->sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ isset($selectedSection) && $selectedSection == $section->id ? 'selected' : '' }}>
                                            {{ $grade->name }} - شعبة ({{ $section->name }})
                                        </option>
                                    @endforeach
                                @else
                                    <!-- إذا كان الصف لا يحتوي على أي شعبة مسجلة -->
                                    <option value="grade_{{ $grade->id }}"
                                        {{ isset($selectedGrade) && $selectedGrade == $grade->id ? 'selected' : '' }}>
                                        {{ $grade->name }} (لا توجد شعب)
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3.5 px-5 rounded-xl text-sm">
                            جلب كشف الطلاب
                        </button>
                    </div>
                </div>
            </form>
            <!-- 2. شرط لارافيل: إظهار الجدول فقط بعد اختيار الشعبة بنجاح -->
            @if ($selectedSection)
                <div id="printable-score-sheet"
                    class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden ">
                    <div class="p-4 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-xs font-black text-slate-800 dark:text-zinc-100">كشف أسماء الطلاب المسجلين في
                                الشعبة</h3>
                            <p class="text-[10px] text-teal-600 font-bold mt-0.5">يمكنك الآن رصد الدرجات وحفظ الكشف بالكامل
                            </p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse text-xs">
                            <thead>
                                <tr
                                    class=" border-b border-gray-100 dark:border-slate-800 text-gray-700 dark:text-gray-400 font-bold">
                                    <th class="py-3.5 px-6">رقم القيد</th>
                                    <th class="py-3.5 px-4">اسم الطالب</th>
                                    <th class="py-3.5 px-4 text-center">آلية تقديم الإختبار</th>
                                    <th class="py-3.5 px-4 text-center">الدرجة المستحقة</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 font-medium text-slate-700">
                                @forelse($students as $student)
                                    @php
                                        $exam = $student->examResults->first();
                                        $score = $exam ? $exam->score_obtained : null;
                                    @endphp

                                    <tr class="text-slate-800 dark:text-zinc-300">
                                        <td class="py-4 px-6 font-bold text-gray-400">#{{ $student->id }}</td>
                                        <td class="py-4 px-4 text-slate-800 dark:text-zinc-300 font-bold">
                                            {{ $student->full_name }}</td>
                                        <td class="py-4 px-4 text-center">
                                            @if ($exam)
                                                <span
                                                    class="px-2.5 py-1 rounded-lg bg-teal-50 text-teal-600 text-[10px] font-bold">
                                                    <i class="fa-solid fa-laptop ml-1"></i> قدم الاختبار إلكترونياً
                                                </span>
                                            @else
                                                <span
                                                    class="px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 text-[10px] font-bold">
                                                    <i class="fa-solid fa-clock ml-1"></i> لم يدخل الاختبار بعد
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4 text-center">
                                            <div class="flex items-center justify-center gap-1">
                                                <!-- عرض العلامة الديناميكية المحسوبة تلقائياً كنص ثابت -->
                                                <span class="text-slate-800 dark:text-zinc-100 font-black text-sm">
                                                    {{ !is_null($score) ? $score : '0' }}
                                                </span>
                                                <span class="text-gray-400 font-bold text-[11px]">/ 100</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if (!is_null($score))
                                                <span
                                                    class="text-emerald-600 font-bold text-[11px] inline-flex items-center gap-1">
                                                    <i class="fa-solid fa-circle-check"></i> مصحح ومقيد تلقائياً
                                                </span>
                                            @else
                                                <span class="text-gray-400 font-bold text-[11px]">انتظار تقديم
                                                    الاختبار</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-8 text-gray-400">لا يوجد طلاب مسجلين في هذه
                                            الشعبة حالياً.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function printSection(sectionId) {
            // 1. جلب محتوى القطعة المراد طباعتها فقط
            var printContents = document.getElementById(sectionId).innerHTML;
            // 2. حفظ محتوى الصفحة الأصلية بالكامل
            var originalContents = document.body.innerHTML;

            // 3. استبدال محتوى الصفحة بمحتوى القطعة المراد طباعتها فقط
            document.body.innerHTML = printContents;

            // 4. استدعاء أمر الطباعة الخاص بالمتصفح
            window.print();

            // 5. إعادة الصفحة لأصلها بعد إغلاق نافذة الطباعة
            document.body.innerHTML = originalContents;

            // إعادة تفعيل أي أحداث أو عناصر بالصفحة بعد الاستبدال
            window.location.reload();
        }
    </script>
@endsection
