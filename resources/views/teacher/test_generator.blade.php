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

    <div class="my-6 mx-auto space-y-6" dir="rtl">
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

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">المادة والصف
                        الدراسي</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none cursor-pointer">
                        <option value="1">اللغة العربية - الصف الأول الإعدادي</option>
                        <option value="2">اللغة العربية - الصف الثاني الإعدادي</option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">إجمالي عدد
                        الأسئلة</label>
                    <div class="relative flex items-center">
                        <input type="number" min="1" max="50" value="10"
                            class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none" />
                        <span class="absolute left-4 text-[10px] text-gray-400 font-bold">سؤال</span>
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">مدة الاختبار
                        الزمنية</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none cursor-pointer">
                        <option value="30">30 دقيقة</option>
                        <option value="45">45 دقيقة</option>
                        <option value="60">ساعة كاملة</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button id="generateQuizBtn" type="button"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs py-3 rounded-xl flex items-center justify-center gap-2 transition shadow-lg shadow-teal-600/10 cursor-pointer h-[38px]">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span>توليد الاختبار وبدء المعاينة</span>
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
                    <button type="button"
                        class="bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-5 py-2.5 rounded-xl transition shadow-lg shadow-teal-600/10 cursor-pointer flex items-center gap-1">
                        <i class="fa-solid fa-floppy-disk"></i> اعتماد ونشر للطلاب
                    </button>
                </div>
            </div>

            <div class="space-y-4 text-xs">
                <div
                    class="p-4 border border-gray-200 hover:border-gray-400 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-950/20 rounded-2xl space-y-3 relative group">
                    <div class="flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <span class="text-gray-400 font-bold">سؤال 1 (اختيار من متعدد)</span>
                            <p class="font-medium text-slate-800 dark:text-zinc-200 text-sm">
                                ميز نوع الخبر في جملة "المدرسةُ فنائُها واسعٌ"?
                            </p>
                        </div>
                        <span
                            class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400 font-bold text-[10px] shrink-0">درجتان</span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1 max-w-xl">
                        <div
                            class="correct-option p-2.5 rounded-xl border border-teal-200 dark:border-teal-900/60 bg-teal-50/30 dark:bg-teal-950/10 text-teal-700 dark:text-teal-400 font-bold flex items-center gap-2">
                            <i class="fa-solid fa-circle-check"></i>
                            <i class="fa-regular fa-circle print-circle-placeholder"></i>
                            <span>أ) خبر جملة اسمية
                                <span class="correct-text font-normal text-xs text-teal-600/80 mr-1">(الإجابة
                                    الصحيحة)</span></span>
                        </div>
                        <div
                            class="p-2.5 rounded-xl border border-gray-200 dark:border-slate-800 text-gray-500 dark:text-zinc-400 flex items-center gap-2">
                            <i class="fa-regular fa-circle"></i> ب) خبر مفرد
                        </div>
                    </div>
                    <button type="button"
                        class="absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white dark:bg-slate-800 shadow-sm border border-gray-200 dark:border-slate-700 text-gray-500 hover:text-amber-500 w-7 h-7 rounded-lg flex items-center justify-center cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate text-[11px]"></i>
                    </button>
                </div>

                <div
                    class="p-4 border border-gray-200 hover:border-gray-400 dark:border-slate-800 bg-gray-50/50 dark:bg-slate-950/20 rounded-2xl space-y-3 relative group">
                    <div class="flex items-start justify-between gap-4">
                        <div class="space-y-1">
                            <span class="text-gray-400 font-bold">سؤال 2 (صح أم خطأ)</span>
                            <p class="font-medium text-slate-800 dark:text-zinc-200 text-sm">
                                الفعل "يسعى" هو فعل معتل الآخر بالـألف.
                            </p>
                        </div>
                        <span
                            class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400 font-bold text-[10px] shrink-0">درجة
                            واحدة</span>
                    </div>

                    <div class="flex items-center gap-6 pt-1">
                        <div class="flex items-center gap-2 text-gray-500 dark:text-zinc-400">
                            <i class="fa-regular fa-square"></i> <span>صح</span>
                            <i class="fa-solid fa-square-check text-emerald-600 correct-tf-icon ml-1"></i>
                            <span class="correct-text text-[11px] font-bold text-emerald-600">(الإجابة
                                الصحيحة)</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-500 dark:text-zinc-400">
                            <i class="fa-regular fa-square"></i> <span>خطأ</span>
                        </div>
                    </div>

                    <button type="button"
                        class="absolute top-2 left-2 opacity-0 group-hover:opacity-100 transition-opacity bg-white dark:bg-slate-800 shadow-sm border border-gray-200 dark:border-slate-700 text-gray-500 hover:text-amber-500 w-7 h-7 rounded-lg flex items-center justify-center cursor-pointer">
                        <i class="fa-solid fa-arrows-rotate text-[11px]"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const generateBtn = document.getElementById("generateQuizBtn");
            const previewSection = document.getElementById("quizPreviewSection");
            const printBtn = document.getElementById("printQuizBtn");

            generateBtn.addEventListener("click", function() {
                generateBtn.innerHTML =
                    `<i class="fa-solid fa-spinner animate-spin"></i> <span>جاري سحب الأسئلة...</span>`;

                setTimeout(() => {
                    previewSection.classList.remove("hidden");
                    generateBtn.innerHTML =
                        `<i class="fa-solid fa-wand-magic-sparkles"></i> <span>توليد الاختبار الآن وبدء المعاينة</span>`;
                    previewSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                }, 500);
            });

            printBtn.addEventListener("click", function() {
                window.print();
            });
        });
    </script>
@endsection
