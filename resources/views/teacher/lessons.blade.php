@extends('teacher.parent')
@section('title', 'الدروس')
@section('content')
    <div class="w-full space-y-6 my-6 text-xs" dir="rtl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-5 rounded-3xl shadow-xs space-y-4">
                <div class="pb-2 border-b border-gray-50 dark:border-slate-800">
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-cloud-arrow-up text-teal-600"></i> نشر درس
                        جديد
                    </h3>
                    <p class="text-[11px] text-slate-700 dark:text-gray-400 font-medium">
                        امْلأ البيانات لبث المحتوى لحسابات الطلاب
                    </p>
                </div>

                <form method="POST" action="{{ route('lessons.store') }}" enctype="multipart/form-data" class="space-y-3.5">
                    @csrf

                    {{-- اختيار المادة المستهدفة --}}
                    {{-- 1. قائمة اختيار المادة (ال كود الخاص بك) --}}
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 dark:text-zinc-300 block">المادة المستهدفة:</label>
                        <select name="subject_id" required id="subject_select" onchange="filterTeacherSections()"
                            class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-200 rounded-xl p-2.5 outline-none font-medium cursor-pointer">
                            <option value="">اختر المادة...</option>
                            @foreach ($teacherSubjects as $subject)
                                <option value="{{ $subject->id }}" data-grade="{{ $subject->grade_id }}">
                                    {{ $subject->name }} ({{ $subject->grade->name ?? '' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- حاوية عرض الشُعب التابعة لصفوف المعلم --}}
                    <div class="space-y-1 mt-3">
                        <label class="font-bold text-slate-700 dark:text-zinc-300 block">الشُعب المستهدفة (المتاحة في
                            صفوفك):</label>
                        <div id="sections_container"
                            class="grid grid-cols-2 gap-2 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-950 rounded-xl p-3 max-h-40 overflow-y-auto">

                            {{-- الدوران حول الشعب المستخرجة عبر صفوف المعلم --}}
                            @foreach ($teacherSubjects as $section)
                                <label data-grade="{{ $section->grade_id }}"
                                    class="section-checkbox-item hidden border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex items-center justify-between gap-2 cursor-pointer bg-gray-50/30 dark:bg-slate-950/20 hover:border-teal-500 transition-all">
                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" name="grades[]" value="{{ $section->id }}"
                                            class="accent-teal-600 rounded w-4 h-4 section-input" />
                                        <span class="font-bold text-xs text-slate-700 dark:text-zinc-300">
                                            {{ $section->grade->name ?? '' }} - شعبة ({{ $section->name }})
                                        </span>
                                    </div>
                                    <span class="text-teal-600 text-xs">
                                        <i class="fa-solid fa-users text-[10px]"></i>
                                    </span>
                                </label>
                            @endforeach

                            <div id="no_subject_hint"
                                class="text-gray-400 dark:text-slate-500 text-xs p-2 col-span-2 text-center">
                                يرجى اختيار المادة أولاً لإظهار الشُعب الدراسية المتاحة لها.
                            </div>
                        </div>
                    </div>

                    {{-- بقية الحقول (عنوان المحاضرة، النوع، الملف، الزر) تبقى كما هي تماماً دون تعديل لسلامة التصميم الخاص بك --}}
                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">عنوان المحاضرة:</label>
                        <input type="text" name="title" required placeholder="مثال: شرح درس المفاعيل الخمسة"
                            class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-200 rounded-xl p-2.5 outline-none font-medium placeholder-gray-400" />
                    </div>

                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">نوع الملف:</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex flex-col items-center justify-center gap-1 cursor-pointer hover:border-teal-500">
                                <input type="radio" name="file_type" value="video"  class="accent-teal-600" />
                                <i class="fa-solid fa-video text-amber-500 text-xs"></i>
                                <span class="font-bold text-[10px]">فيديو شرح</span>
                            </label>
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex flex-col items-center justify-center gap-1 cursor-pointer hover:border-teal-500">
                                <input type="radio" name="file_type" value="pdf" class="accent-teal-600" />
                                <i class="fa-solid fa-file-pdf text-rose-500 text-xs"></i>
                                <span class="font-bold text-[10px]">ملف PDF</span>
                            </label>
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex flex-col items-center justify-center gap-1 cursor-pointer hover:border-teal-500">
                                <input type="radio" name="file_type" value="link" class="accent-teal-600" />
                                <i class="fa-solid fa-bezier-curve text-indigo-500 text-xs"></i>
                                <span class="font-bold text-[10px]">مرفق خارجي</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">ملف الشرح المرفق:</label>
                        <div onclick="document.getElementById('uploadFileMain').click()"
                            class="bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 rounded-2xl p-4 text-center cursor-pointer">
                            <i class="fa-solid fa-cloud-arrow-up text-teal-600 text-base mb-1 animate-pulse"></i>
                            <p id="fileNameDisplay" class="font-bold text-slate-700 dark:text-zinc-300">
                                اسحب الملف هنا أو اضغط للتصفح
                            </p>
                            <p class="text-[9px] text-gray-400 mt-0.5">الحد الأقصى للمحاضرة 60MB</p>
                            <input type="file" name="file" id="uploadFileMain" onchange="displaySelectedName()"
                                class="hidden" />
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white shadow-md shadow-teal-700/10 font-black mt-4 py-2.5 rounded-xl cursor-pointer text-center">
                        نشر المحاضرة للطلاب <i class="fa-solid fa-share-nodes ml-1"></i>
                    </button>
                </form>
            </div>

            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-5 rounded-3xl shadow-xs flex flex-col space-y-4">
                <div class="pb-2 border-b border-gray-50 dark:border-slate-800">
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                        📂 أرشيف الدروس المنشورة تحت إشرافك
                    </h3>
                    <p class="text-[11px] text-slate-700 dark:text-gray-400 font-medium">
                        متابعة حجم التحميلات والمشاهدات لكل درس تعليمي مرفوع
                    </p>
                </div>

                <div class="space-y-3 flex-1 overflow-y-auto max-h-[440px] pl-1">
                    @forelse ($lessons as $lesson)
                        <div
                            class="p-3.5 border border-gray-100 dark:border-slate-800/60 bg-gray-50/10 dark:bg-slate-950/20 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/40 flex items-center justify-center text-sm shrink-0">
                                    <i class="fa-solid fa-video"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        {{ $lesson->title }}
                                    </h4>
                                    <p class="text-[10px] text-gray-400">
                                        المادة:
                                        <span
                                            class="text-teal-600 font-bold">{{ $lesson->subject->name ?? 'مادة محذوفة أو غير معرفة' }}</span>
                                        • الشُعب:
                                        <span class="font-medium text-slate-600 dark:text-zinc-300">
                                            @if ($lesson->subject && $lesson->subject->grade)
                                                @foreach ($lesson->subject->grade->sections as $section)
                                                    ({{ $section->name }})
                                                    {{ !$loop->last ? '، ' : '' }}
                                                @endforeach
                                            @else
                                                <span class="text-xs text-gray-400">غير محدد</span>
                                            @endif
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('lessons.destroy', $lesson->id) }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-white dark:bg-slate-800 text-rose-500 border border-gray-200 dark:border-slate-700 font-bold px-2.5 py-1.5 rounded-xl hover:bg-rose-50 cursor-pointer text-[10px] shrink-0 w-fit">
                                    <i class="fa-solid fa-trash-can"></i> حذف المحاضرة
                                </button>
                            </form>

                        </div>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-16 text-gray-400 text-sm">
                                <i class="fa-solid fa-video-slash text-3xl mb-3 block"></i>
                                لا يوجد دروس مرفوعة بعد
                            </td>
                        </tr>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function filterTeacherSections() {
            const subjectSelect = document.getElementById('subject_select');
            const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];

            // جلب معرف الصف التابع للمادة المختارة
            const targetGradeId = selectedOption.getAttribute('data-grade');
            const hint = document.getElementById('no_subject_hint');

            // جلب جميع عناصر الصفوف داخل الحاوية
            const sectionItems = document.querySelectorAll('.section-checkbox-item');

            // إعادة إلغاء تحديد الـ checkboxes عند تغيير المادة لمنع إرسال بيانات خاطئة
            document.querySelectorAll('.grade-input').forEach(input => input.checked = false);

            if (!targetGradeId) {
                // إذا لم يتم اختيار مادة، نخفي كل الصفوف ونظهر رسالة التنبيه
                sectionItems.forEach(item => item.classList.add('hidden'));
                hint.classList.remove('hidden');
                return;
            }

            // إخفاء رسالة التنبيه
            hint.classList.add('hidden');

            // فلترة وإظهار الصف الذي يطابق المادة المختارة فقط
            sectionItems.forEach(item => {
                const itemGradeId = item.getAttribute('data-grade');

                if (itemGradeId === targetGradeId) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        function displaySelectedName() {
            const fileInput = document.getElementById('uploadFileMain');
            const nameDisplay = document.getElementById('fileNameDisplay');

            // التحقق من أن المستخدم قام باختيار ملف بالفعل ولم يغلق النافذة
            if (fileInput.files && fileInput.files.length > 0) {
                // جلب اسم الملف الأول المحدد
                const fileName = fileInput.files[0].name;

                // تحديث النص وتغيير لونه وشكله ليعطي إيحاءً بالنجاح
                nameDisplay.innerHTML =
                    `<i class="fa-solid fa-file-circle-check text-emerald-500 ml-1"></i> <span class="text-emerald-600 font-bold">${fileName}</span>`;
            } else {
                // إعادة النص الأصلي في حال إلغاء الاختيار
                nameDisplay.innerText = "اسحب الملف هنا أو اضغط للتصفح";
            }
        }
    </script>
@endsection
