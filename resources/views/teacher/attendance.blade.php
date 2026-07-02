@extends('teacher.parent')
@section('title', 'الحضور')
@section('styles')
    {{-- كود الـ CSS لتلوين الزر المحدد تلقائياً بناءً على اختيار المعلم الفعلي --}}
    <style>
        input[type="radio"]:checked+.label-present {
            background-color: #059669;
            /* bg-emerald-600 */
            border-color: #059669;
            color: white;
        }

        input[type="radio"]:checked+.label-late {
            background-color: #f59e0b;
            /* bg-amber-500 */
            border-color: #f59e0b;
            color: white;
        }

        input[type="radio"]:checked+.label-absent {
            background-color: #e11d48;
            /* bg-rose-600 */
            border-color: #e11d48;
            color: white;
        }
    </style>
@endsection
@section('content')
    {{-- تدوين الحقول داخل فورم واحد يرسل البيانات لـ Controller --}}
    <form method="POST" action="{{ route('attendance.store') }}" class="mx-auto my-6 space-y-6" dir="rtl">
        @csrf
        {{-- حقول مخفية لحفظ التاريخ الحالي المختار لإرساله مع الحضور --}}
        <input type="hidden" name="date" value="{{ request('date', date('Y-m-d')) }}">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-4 flex-1 justify-start">
                <div class="w-full sm:w-64">
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 mb-1">الصف الدراسي</label>
                    {{-- إضافة id وتفعيل Submit تلقائي عند تغيير الصف لتحديث القائمة --}}
                    <select name="class_section" {{-- تحديث الصفحة تلقائياً وجلب بيانات الطلاب بمجرد أن يختار المعلم "الصف" أو يغير "التاريخ"، بدون الحاجة لوجود زر "بحث" يضغط عليه المعلم. --}}
                        onchange="this.form.method='GET'; this.form.action='{{ route('attendance.index') }}'; this.form.submit();"
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:border-emerald-600 cursor-pointer">
                        <option value="">-- اختر الصف والشعبة --</option>
                        @foreach ($teacherClasses as $class)
                            @php
                                $currentValue = $class->academic_level . '|' . $class->section_name;
                            @endphp
                            <option value="{{ $currentValue }}"
                                {{ request('class_section') == $currentValue ? 'selected' : '' }}>
                                {{ $class->academic_level }} - شعبة ({{ $class->section_name }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full sm:w-48">
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 mb-1">التاريخ</label>
                    {{-- ربط حقل التاريخ بالطلب وجعله يعمل Submit لتحديث الحالات بناءً على اليوم المختار --}}
                    <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}"
                        onchange="this.form.method='GET'; this.form.action='{{ route('attendance.index') }}'; this.form.submit();"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:outline-none focus:ring-2 focus:ring-teal-600" />
                </div>
            </div>

            {{-- زر تحديد الكل حاضر عبر جافاسكريبت سريعة --}}
            <button type="button" onclick="checkAllPresent()"
                class="w-full md:w-auto bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-6 py-3 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/10 cursor-pointer">
                <i class="fa-solid fa-check-double"></i>
                <span>تحديد الكل حاضر</span>
            </button>
        </div>

        @if (count($students) > 0)
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-4">
                <div class="flex items-center justify-between border-b border-gray-100 dark:border-slate-800 pb-4">
                    <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                        قائمة الطلاب (<span>{{ count($students) }}</span>)
                    </h2>
                    <div class="flex items-center gap-2 text-[10px] font-bold">
                        <span
                            class="px-2 py-0.5 rounded bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400">حاضر</span>
                        <span
                            class="px-2 py-0.5 rounded bg-amber-50 text-amber-600 dark:bg-amber-950/30 dark:text-amber-400">متأخر</span>
                        <span
                            class="px-2 py-0.5 rounded bg-rose-50 text-rose-600 dark:bg-rose-950/30 dark:text-rose-400">غائب</span>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach ($students as $student)
                        @php
                            // جلب الحالة القديمة المخزنة في قاعدة البيانات لهذا الطالب إن وجدت، وإلا يكون الافتراضي حاضر
                            $status = $existingAttendance[$student->id] ?? 'present';
                        @endphp
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between border border-gray-100 dark:border-slate-800 p-4 rounded-2xl gap-4 bg-white dark:bg-slate-900 hover:border-gray-200 dark:hover:border-slate-700">
                            <div class="flex items-center gap-3 w-full sm:w-auto">
                                {{-- جلب الحرف الأول من اسم الطالب ديناميكياً لتعبئة الأفاتار الدراسي --}}
                                <div
                                    class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 font-bold flex items-center justify-center shrink-0 shadow-inner">
                                    {{ mb_substr($student->full_name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-xs font-bold text-slate-800 dark:text-zinc-100">
                                        {{ $student->full_name }}
                                    </h4>
                                    <p class="text-[10px] text-gray-400 font-mono mt-0.5">
                                        {{ $student->student_code ?? 'STU-' . $student->id }}
                                    </p>
                                </div>
                            </div>

                            {{-- أزرار رصد الحضور الذكية عبر الـ Radio Buttons المخفية بمظهر تيلويند الأنيق --}}
                            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">

                                <label class="cursor-pointer">
                                    <input type="radio" name="attendance[{{ $student->id }}]" value="present"
                                        class="hidden present-radio" {{ $status == 'present' ? 'checked' : '' }}>
                                    <span
                                        class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 transition-all duration-200 label-present">
                                        <i class="fa-solid fa-check text-[10px]"></i> حاضر
                                    </span>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="attendance[{{ $student->id }}]" value="late"
                                        class="hidden" {{ $status == 'late' ? 'checked' : '' }}>
                                    <span
                                        class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 transition-all duration-200 label-late">
                                        <i class="fa-solid fa-clock text-[10px]"></i> متأخر
                                    </span>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="attendance[{{ $student->id }}]" value="absent"
                                        class="hidden" {{ $status == 'absent' ? 'checked' : '' }}>
                                    <span
                                        class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 transition-all duration-200 label-absent">
                                        <i class="fa-solid fa-xmark text-[10px]"></i> غائب
                                    </span>
                                </label>

                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- زر الحفظ النهائي ليرسل مصفوفة الحضور للباك إند --}}
                <div class="pt-4 border-t border-gray-100 dark:border-slate-800 flex justify-end">
                    <button type="submit"
                        onclick="this.form.method='POST'; this.form.action='{{ route('attendance.store') }}';"
                        class="bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg shadow-teal-600/10 cursor-pointer">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>حفظ الحضور</span>
                    </button>
                </div>
            </div>
        @elseif(request('class_section'))
            {{-- رسالة تنبيه منسقة في حال لا يوجد طلاب بالشعبة المحددة --}}
            <div
                class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800 p-16 rounded-3xl text-center text-gray-400">
                <i class="fa-solid fa-users-slash text-4xl mb-3 block text-teal-600/60"></i>
                لا يوجد طلاب مسجلين في هذا الصف أو الشعبة حالياً.
            </div>
        @endif
    </form>
@endsection
@section('scripts')
    {{-- كود الجافاسكريبت لتشغيل ميزة "تحديد الكل حاضر" كبسة زر واحدة --}}
    <script>
        function checkAllPresent() {
            // 1. جلب جميع حقول الراديو الخاصة بكلمة "حاضر"
            const presentRadios = document.querySelectorAll('.present-radio');

            presentRadios.forEach(radio => {
                // 2. تفعيل الخيار برمجياً
                radio.checked = true;

                // 3. إطلاق حدث 'change' يدوياً لكي يشعر المتصفح بالتغيير ويقوم الـ CSS بتلوين الزر باللون الأخضر
                radio.dispatchEvent(new Event('change', {
                    bubbles: true
                }));
            });
        }
    </script>
@endsection
