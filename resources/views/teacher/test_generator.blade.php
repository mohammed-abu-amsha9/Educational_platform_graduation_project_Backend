@extends('teacher.parent')
@section('title', 'مولد الاختبارات')
@section('styles')
    <style>
        @media print {

            /* إخفاء كل شيء في الصفحة لمنع طباعة القوائم أو الفلاتر */
            body * {
                visibility: hidden;
            }

            /* إظهار قسم معاينة الاختبار فقط وما بداخله */
            #quizPreviewSection,
            #quizPreviewSection * {
                visibility: visible;
            }

            /* ضبط مكان قسم المعاينة ليأخذ الصفحة الكاملة وبيضاء تماماً */
            #quizPreviewSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                border: none !important;
                box-shadow: none !important;
                background: white !important;
                color: black !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            /* إخفاء الأزرار والأيقونات التفاعلية التي لا داعي لظهورها في الورقة المطبوعة */
            #printQuizBtn,
            #quizPreviewSection button,
            #quizPreviewSection .opacity-0,
            .border-b.border-gray-100 flex {
                display: none !important;
            }

            /* ========================================== */
            /* إخفاء معالم الإجابة الصحيحة عند الطباعة للطلاب */
            /* ========================================== */
            /* 1. إخفاء النصوص التوضيحية للإجابة الصحيحة */
            .correct-text {
                display: none !important;
            }

            /* 2. تحويل الخيار الصحيح لشكل خيار عادي (بدون خلفية ملونة) */
            .correct-option {
                background-color: transparent !important;
                background: transparent !important;
                border-color: #e2e8f0 !important;
                /* لون رمادي عادي */
                color: #64748b !important;
                /* لون نص عادي */
            }

            /* 3. إخفاء أيقونات الصح المرافقة للإجابات الصحيحة واستبدالها بدائرة عادية */
            .correct-option i.fa-circle-check {
                display: none !important;
            }

            .correct-option .print-circle-placeholder {
                display: inline-block !important;
            }

            /* 4. إخفاء علامة الصح في أسئلة الصح والخطأ */
            .correct-tf-icon {
                display: none !important;
            }
        }

        /* لإخفاء الدائرة الافتراضية في وضع العرض العادي داخل الموقع */
        .print-circle-placeholder {
            display: none;
        }
    </style>
@endsection
@section('content')

    <form method="POST" action="{{route('exams.store')}}" class="my-6 mx-auto space-y-6" dir="rtl" id="quizGeneratorForm">
        @csrf
        <div id="setupSection"
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-6 rounded-3xl shadow-sm space-y-6 transition-all">
            <div class="flex items-center gap-2 border-b border-gray-100 dark:border-slate-800 pb-4">
                <div
                    class="w-8 h-8 rounded-xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600">
                    <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        مولد الاختبارات التلقائي
                    </h2>
                    <p class="text-[11px] text-slate-700 dark:text-gray-400 font-medium">
                        قم بتحديد المعايير ليقوم النظام بسحب الأسئلة وتجهيز الاختبار
                        فوراً
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-4 text-xs items-end">

                <div class="lg:col-span-2">
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">المادة والصف الدراسي</label>
                    <select name="class_section" class="w-full border border-gray-200 rounded-xl p-2 text-sm">
                        <option value="">-- كل الصفوف والمواد --</option>

                        {{-- الدوران على صفوف المعلم المحددة له فقط --}}
                        @foreach ($teacherGrades as $grade)
                            {{-- فلترة المواد: نعرض فقط مواد المعلم التي تنتمي لهذا الصف الحالي (بناءً على grade_id داخل المادة) --}}
                            @php
                                $currentGradeSubjects = $teacherSubjects->where('grade_id', $grade->id);
                            @endphp

                            @foreach ($currentGradeSubjects as $subject)
                                @php
                                    // تركيب القيمة الفريدة المكونة من معرف الصف ومعرف المادة
                                    $valueString = $grade->id . '|' . $subject->id;
                                @endphp
                                <option value="{{ $valueString }}"
                                    {{ request('class_section') == $valueString ? 'selected' : '' }}>
                                    {{ $grade->name }} - مادة ({{ $subject->name }})
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="lg:col-span-1">
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">علامة الامتحان</label>
                    <div class="relative flex items-center h-[38px]">
                        <input type="number" min="1" max="50" value="10" name="Total_score"
                            class="w-full h-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl px-3 outline-none pl-12" />
                        <span class="absolute left-3 text-[10px] text-gray-400 font-bold">علامة</span>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">عدد الأسئلة</label>
                    <div class="relative flex items-center h-[38px]">
                        <input type="number" min="1" max="50" value="10" name="total_questions"
                            class="w-full h-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl px-3 outline-none pl-12" />
                        <span class="absolute left-3 text-[10px] text-gray-400 font-bold">سؤال</span>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">مدة الاختبار</label>
                    <select name="Exam_duration"
                        class="w-full h-[38px] border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl px-3 outline-none cursor-pointer text-center">
                        <option value="30">15 دقيقة</option>
                        <option value="30">30 دقيقة</option>
                        <option value="45">45 دقيقة</option>
                        <option value="60">ساعة كاملة</option>
                        <option value="90">ساعة ونصف</option>
                        <option value="120">ساعتين</option>
                    </select>
                </div>

                <div class="lg:col-span-3">
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">فترة الإتاحة</label>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-[10px] text-gray-400 dark:text-slate-500 font-bold pr-1">من:</span>
                            <input type="time" value="09:00" name="Start_time"
                                class="w-full h-[38px] border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl px-3 outline-none cursor-pointer text-center" />
                        </div>
                        <div class="flex flex-col gap-0.5">
                            <span class="text-[10px] text-gray-400 dark:text-slate-500 font-bold pr-1">إلى:</span>
                            <input type="time" value="17:00" name="End_Time"
                                class="w-full h-[38px] border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl px-3 outline-none cursor-pointer text-center" />
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <button id="generateQuizBtn" type="button"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 transition shadow-lg shadow-teal-600/10 cursor-pointer h-[38px]">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span class="whitespace-nowrap">توليد وبدء المعاينة</span>
                    </button>
                </div>

            </div>
        </div>

        <div id="quizPreviewSection"
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-6 transition-all hidden">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-gray-100 dark:border-slate-800 pb-4">
                <div>
                    <span
                        class="px-2 py-0.5 rounded bg-amber-50 text-amber-600 dark:bg-amber-950/40 dark:text-amber-400 text-[10px] font-black mb-1 inline-block">مسوّدة
                        اختبار قيد المراجعة</span>
                    <h3 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        المعاينة الحية للاختبار المتولد
                    </h3>
                </div>

                <div class="flex items-center gap-2">
                    <button id="printQuizBtn" type="button"
                        class="bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-700 dark:text-zinc-300 font-bold text-xs px-4 py-2.5 rounded-xl transition cursor-pointer flex items-center gap-1">
                        <i class="fa-solid fa-print text-teal-600"></i>
                        <span>طباعة الاختبار للطلاب</span>
                    </button>
                    <button type="submit"
                        class="bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition shadow-lg shadow-teal-600/10 cursor-pointer flex items-center gap-1">
                        <i class="fa-solid fa-floppy-disk"></i> اعتماد ونشر للطلاب
                    </button>
                </div>
            </div>

            <!-- هنا سيتم حقن الأسئلة القادمة من السيرفر تلقائياً -->
            <div id="questionsContainer" class="space-y-4 text-xs"></div>
        </div>
    </form>
@endsection
@section('scripts')
    <script font-theme="pure-js">
        document.addEventListener("DOMContentLoaded", function() {
            const generateBtn = document.getElementById("generateQuizBtn");
            const previewSection = document.getElementById("quizPreviewSection");
            const questionsContainer = document.getElementById("questionsContainer");
            const printBtn = document.getElementById("printQuizBtn");

            // تأكد من لقط عنصر الـ select سواء كان له id أو اسم
            const classSectionSelect = document.getElementById('class_section_select') || document.querySelector(
                'select[name="class_section"]');

            if (generateBtn) {
                generateBtn.addEventListener("click", function(e) {
                    // منع أي سلوك افتراضي قد يعطل الزر
                    e.preventDefault();

                    const classSectionValue = classSectionSelect ? classSectionSelect.value : '';
                    const totalQuestions = document.getElementsByName("total_questions")[0]?.value || 5;

                    // التحقق من أن المعلم اختار مادة وصف
                    if (!classSectionValue) {
                        alert("الرجاء اختيار الصف والمادة أولاً من القائمة!");
                        return;
                    }

                    // 1. تحويل الزر إلى حالة التحميل (Loading)
                    generateBtn.disabled = true;
                    generateBtn.innerHTML =
                        `<i class="fa-solid fa-spinner animate-spin"></i> <span>جاري سحب الأسئلة...</span>`;

                    // 2. إرسال طلب الـ AJAX للمسار التابع لـ Resource (exams.fetch-questions)
                    fetch("{{ route('exams.fetch-questions') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                class_section: classSectionValue,
                                total_questions: totalQuestions
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // تصفير قسم المعاينة القديم
                            questionsContainer.innerHTML = "";

                            if (data.success && data.questions && data.questions.length > 0) {

                                // حساب العلامة لكل سؤال بناءً على إجمالي علامة الامتحان المدخلة
                                const totalScoreInput = parseFloat(document.getElementsByName(
                                    "Total_score")[0]?.value) || 10;
                                const markPerQuestion = (totalScoreInput / data.questions.length)
                                    .toFixed(1);

                                // بناء الأسئلة ديناميكياً بناءً على النوع
                                data.questions.forEach((question, index) => {
                                    let optionsHtml = "";

                                    if (question.type === 'mcq' || question.type ===
                                        'multiple_choice') {
                                        optionsHtml =
                                            `<div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1 max-w-xl">`;
                                        if (question.options) {
                                            question.options.forEach((opt) => {
                                                const isCorrect = opt.is_correct == 1 ||
                                                    opt.id == question
                                                    .correct_option_id;
                                                optionsHtml += `
                                            <div class="${isCorrect ? 'correct-option p-2.5 rounded-xl border border-teal-200 dark:border-teal-900/60 bg-teal-50/30 dark:bg-teal-950/10 text-teal-700 dark:text-teal-400 font-bold' : 'p-2.5 rounded-xl border border-gray-200 dark:border-slate-800 text-gray-500 dark:text-zinc-400'} flex items-center gap-2">
                                                <i class="${isCorrect ? 'fa-solid fa-circle-check' : 'fa-regular fa-circle'}"></i>
                                                <span>${opt.text || opt.option_text} ${isCorrect ? '<span class="correct-text font-normal text-xs text-teal-600/80 mr-1">(الإجابة الصحيحة)</span>' : ''}</span>
                                            </div>`;
                                            });
                                        }
                                        optionsHtml += `</div>`;
                                    } else if (question.type === 'tf' || question.type ===
                                        'true_false') {
                                        const isTrueCorrect = question.correct_answer ===
                                            'true' || question.correct_answer == 1;
                                        optionsHtml = `
                                    <div class="flex items-center gap-6 pt-1">
                                        <div class="flex items-center gap-2 text-gray-500 dark:text-zinc-400">
                                            <i class="${isTrueCorrect ? 'fa-solid fa-square-check text-emerald-600' : 'fa-regular fa-square'}"></i>
                                            <span>صح ${isTrueCorrect ? '<span class="correct-text text-[11px] font-bold text-emerald-600">(الإجابة الصحيحة)</span>' : ''}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-500 dark:text-zinc-400">
                                            <i class="${!isTrueCorrect ? 'fa-solid fa-square-check text-emerald-600' : 'fa-regular fa-square'}"></i>
                                            <span>خطأ ${!isTrueCorrect ? '<span class="correct-text text-[11px] font-bold text-emerald-600">(الإجابة الصحيحة)</span>' : ''}</span>
                                        </div>
                                    </div>`;
                                    }

                                    const questionTemplate = `
                                <div class="p-4 border border-gray-200 hover:border-gray-400 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-950/20 rounded-2xl space-y-3 relative group">
                                    <input type="hidden" name="question_ids[]" value="${question.id}">
                                    <div class="flex items-start justify-between gap-4">
                                        <div class="space-y-1">
                                            <span class="text-gray-400 font-bold">سؤال ${index + 1}</span>
                                            <p class="font-medium text-slate-800 dark:text-zinc-200 text-sm">${question.text || question.question_text}</p>
                                        </div>
                                        <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400 font-bold text-[10px] shrink-0">${markPerQuestion} درجة</span>
                                    </div>
                                    ${optionsHtml}
                                </div>`;

                                    questionsContainer.insertAdjacentHTML('beforeend',
                                        questionTemplate);
                                });

                                // إظهار قسم المعاينة والنزول إليه بسلاسة
                                previewSection.classList.remove("hidden");
                                previewSection.scrollIntoView({
                                    behavior: "smooth",
                                    block: "start"
                                });

                            } else {
                                alert(data.message ||
                                    "لم يتم العثور على أسئلة لهذا الصف والمادة في بنك الأسئلة.");
                            }
                        })
                        .catch(error => {
                            console.error("Fetch Error:", error);
                            alert("حدث خطأ في الاتصال بالخادم أثناء توليد الاختبار.");
                        })
                        .finally(() => {
                            // إعادة الزر لوضعه الأصلي
                            generateBtn.disabled = false;
                            generateBtn.innerHTML =
                                `<i class="fa-solid fa-wand-magic-sparkles"></i> <span>توليد وبدء المعاينة</span>`;
                        });
                });
            }

            if (printBtn) {
                printBtn.addEventListener("click", function() {
                    window.print();
                });
            }
        });
    </script>
    <script>
        // 1. الدالة الأساسية لتحديث الرابط وإعادة تحميل الصفحة بناءً على الفلتر
        function filterQuestions(key, value) {
            let url = new URL(window.location.href);
            let params = new URLSearchParams(url.search);

            if (value === '' || value === 'all') {
                params.delete(key);
            } else {
                params.set(key, value);
            }

            // إعادة توجيه المتصفح للرابط الجديد مع الحفاظ على الفلاتر الأخرى
            window.location.href = url.pathname + '?' + params.toString();
        }

        // 2. ربط فلتر "الصف والمادة" ليعيد تحميل الصفحة فوراً عند تغيير الاختيار
        // تأكد أن عنصر الـ select يحتوي على المعرف id="class_section_select" أو أضفه له
        const classSectionSelect = document.getElementById('class_section_select') || document.querySelector(
            'select[name="class_section"]');

        if (classSectionSelect) {
            classSectionSelect.addEventListener('change', function() {
                // استدعاء دالة الفلترة وتمرير الاسم والقيمة المركبة (مثل 1|3)
                filterQuestions('class_section', this.value);
            });
        }

        // 3. الجزء الخاص بتبديل واجهة إضافة الأسئلة (MCQ / True-False) كما هي لديك
        const questionTypeSelect = document.getElementById('questionTypeSelect');
        if (questionTypeSelect) {
            questionTypeSelect.addEventListener('change', function() {
                const mcqSection = document.getElementById('mcqSection');
                const tfSection = document.getElementById('tfSection');

                if (this.value === 'mcq') {
                    mcqSection?.classList.remove('hidden');
                    tfSection?.classList.add('hidden');
                } else if (this.value === 'tf') {
                    tfSection?.classList.remove('hidden');
                    mcqSection?.classList.add('hidden');
                } else {
                    mcqSection?.classList.add('hidden');
                    tfSection?.classList.add('hidden');
                }
            });
        }
    </script>
@endsection
