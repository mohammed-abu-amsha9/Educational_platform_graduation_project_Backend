@extends('teacher.parent')
@section('title', 'رصد الاختبارات')
@section('content')

    <div class="my-6 mx-auto space-y-6" dir="rtl">
        <div id="setupSection"
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-6 rounded-3xl shadow-sm space-y-6 transition-all">
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
                        يتم تصحيح الاختبارات الإلكترونية ورصدها تلقائياً، يمكنك مراجعة
                        وتدقيق الدرجات من هنا
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-xs">
                <div>
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">المادة والصف
                        الدراسي</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none cursor-pointer">
                        <option value="1">
                            اللغة العربية - الصف الأول الإعدادي (أ)
                        </option>
                        <option value="2">
                            اللغة العربية - الصف الأول الإعدادي (ب)
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">اختر الاختبار
                        الإلكتروني</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none cursor-pointer">
                        <option value="ex1">
                            الاختبار القصير الأول - النحو (مصحح تلقائياً)
                        </option>
                        <option value="ex2">
                            اختبار منتصف الفصل الدراسي (يحتوي على مقالي)
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">تصفية حالة الطلاب</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none cursor-pointer">
                        <option value="all">عرض جميع الطلاب المختبرين</option>
                        <option value="needs-review">
                            طلاب يحتاجون مراجعة (أسئلة مقالية)
                        </option>
                        <option value="absent">الغائبون عن الاختبار</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button id="loadGradesBtn" type="button"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs py-3 rounded-xl flex items-center justify-center gap-2 transition shadow-lg shadow-teal-600/10 cursor-pointer h-[38px]">
                        <i class="fa-solid fa-sync"></i>
                        <span>جلب وإظهار الدرجات المرصودة</span>
                    </button>
                </div>
            </div>
        </div>

        <div id="statsSection" class="grid grid-cols-1 sm:grid-cols-3 gap-4 hidden">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-4 rounded-2xl flex items-center justify-between text-xs">
                <div class="space-y-1">
                    <span class="text-gray-700 dark:text-gray-400 font-bold block">نسبة التصحيح التلقائي</span>
                    <span class="text-lg font-black text-slate-800 dark:text-zinc-100">24 / 25 طالباً</span>
                </div>
                <span
                    class="px-2 py-1 bg-teal-50 text-teal-600 dark:bg-teal-950/40 dark:text-teal-400 rounded-lg font-black">96%
                    تم رصده</span>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-4 rounded-2xl flex items-center justify-between text-xs">
                <div class="space-y-1">
                    <span class="text-gray-700 dark:text-gray-400 font-bold block">متوسط درجات النظام</span>
                    <span class="text-lg font-black text-slate-800 dark:text-zinc-100">17.2 / 20</span>
                </div>
                <span
                    class="px-2 py-1 bg-emerald-50 text-emerald-600 dark:bg-emerald-950/40 dark:text-emerald-400 rounded-lg font-black">مرتفع
                    ↑</span>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-4 rounded-2xl flex items-center justify-between text-xs">
                <div class="space-y-1">
                    <span class="text-gray-700 dark:text-gray-400 font-bold block">نسبة النجاح الافتراضية</span>
                    <span class="text-lg font-black text-slate-800 dark:text-zinc-100">92%</span>
                </div>
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
            </div>
        </div>

        <div id="gradesTableSection"
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 rounded-3xl shadow-sm overflow-hidden hidden transition-all">
            <div
                class="p-4 border-b border-gray-100 dark:border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-xs animate-pulse"></i>
                    <div>
                        <h3 class="text-xs font-black text-slate-800 dark:text-zinc-100">
                            كشف الدرجات المسحوبة من نظام حلول الطلاب
                        </h3>
                        <p class="text-[10px] text-teal-600 font-bold mt-0.5">
                            <i class="fa-solid fa-bolt"></i> التعديلات على الدرجات هنا
                            تعتبر بونص أو مراجعة يدوية وتُحفظ لحظياً
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button"
                        class="bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-700 dark:text-zinc-300 font-bold text-[11px] px-4 py-2 rounded-xl transition cursor-pointer">
                        <i class="fa-solid fa-file-excel text-emerald-600 ml-1"></i>
                        تصدير الكشف
                    </button>
                    <button type="button"
                        class="bg-teal-700 hover:bg-teal-800 text-white font-bold text-[11px] px-4 py-2 rounded-xl transition shadow-sm cursor-pointer">
                        إرسال وتثبيت في الشهادات
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right text-xs border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50/70 dark:bg-slate-950/40 text-gray-700 dark:text-gray-400 font-bold border-b border-gray-100 dark:border-slate-800/80">
                            <th class="py-3.5 px-6">رقم القيد</th>
                            <th class="py-3.5 px-4">اسم الطالب</th>
                            <th class="py-3.5 px-4 text-center">طريقة تقديم الاختبار</th>
                            <th class="py-3.5 px-4 text-center" style="width: 150px">
                                الدرجة المستحقة
                            </th>
                            <th class="py-3.5 px-6 text-center">حالة الرصد الذكي</th>
                        </tr>
                    </thead>
                    <tbody
                        class="divide-y divide-gray-100 dark:divide-slate-800/50 font-medium text-slate-700 dark:text-zinc-300">
                        <tr class="hover:bg-gray-50/40 dark:hover:bg-slate-950/20 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-400">#10294</td>
                            <td class="py-4 px-4 text-slate-900 dark:text-zinc-100 font-bold">
                                أحمد محمد عبد الله مصطفى
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-teal-50 dark:bg-teal-950/30 text-teal-600 dark:text-teal-400 text-[10px] font-bold"><i
                                        class="fa-solid fa-laptop ml-1"></i>حساب الطالب
                                    الإلكتروني</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <input type="number" min="0" max="20" value="19"
                                        class="w-14 text-center border border-emerald-200 dark:border-emerald-900 bg-emerald-50/30 dark:bg-emerald-950/10 text-emerald-700 dark:text-emerald-400 font-black rounded-lg py-1 px-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600" />
                                    <span class="text-gray-400 font-bold text-[11px]">/ 20</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="text-emerald-600 font-bold text-[11px] inline-flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check"></i> مصحح ومقيد
                                    تلقائياً
                                </span>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50/40 dark:hover:bg-slate-950/20 transition-colors">
                            <td class="py-4 px-6 font-bold text-gray-400">#10295</td>
                            <td class="py-4 px-4 text-slate-900 dark:text-zinc-100 font-bold">
                                خالد وليد أنور الكردي
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-teal-50 dark:bg-teal-950/30 text-teal-600 dark:text-teal-400 text-[10px] font-bold"><i
                                        class="fa-solid fa-laptop ml-1"></i>حساب الطالب
                                    الإلكتروني</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <input type="number" min="0" max="20" value="14"
                                        class="w-14 text-center border border-emerald-200 dark:border-emerald-900 bg-emerald-50/30 dark:bg-emerald-950/10 text-emerald-700 dark:text-emerald-400 font-black rounded-lg py-1 px-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-600" />
                                    <span class="text-gray-400 font-bold text-[11px]">/ 20</span>
                                </div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="text-emerald-600 font-bold text-[11px] inline-flex items-center gap-1">
                                    <i class="fa-solid fa-circle-check"></i> مصحح ومقيد
                                    تلقائياً
                                </span>
                            </td>
                        </tr>

                        <tr
                            class="hover:bg-gray-50/40 dark:hover:bg-slate-950/20 transition-colors text-gray-400 dark:text-slate-500">
                            <td class="py-4 px-6 font-bold">#10297</td>
                            <td class="py-4 px-4 line-through">عمر فاروق صلاح الدين</td>
                            <td class="py-4 px-4 text-center">
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-950/20 text-rose-600 dark:text-rose-400 text-[10px] font-bold"><i
                                        class="fa-solid fa-user-slash ml-1"></i>لم يدخل
                                    الاختبار</span>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="font-black text-sm text-rose-500">غائب</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="font-bold text-[11px] text-gray-400 dark:text-slate-500">تم رصده غياب
                                    تلقائياً</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const loadBtn = document.getElementById("loadGradesBtn");
            const statsSection = document.getElementById("statsSection");
            const tableSection = document.getElementById("gradesTableSection");

            loadBtn.addEventListener("click", function() {
                // إظهار تأثير التحميل من السيرفر
                loadBtn.innerHTML =
                    `<i class="fa-solid fa-spinner animate-spin"></i> <span>جاري مزامنة وسحب الدرجات...</span>`;

                setTimeout(() => {
                    // إظهار الأقسام بعد سحب البيانات التلقائي بنجاح
                    statsSection.classList.remove("hidden");
                    tableSection.classList.remove("hidden");

                    // إعادة شكل الزر لحالته الأصلية
                    loadBtn.innerHTML =
                        `<i class="fa-solid fa-sync"></i> <span>جلب وإظهار الدرجات المرصودة</span>`;

                    // سكرول ناعم لعرض الجدول بالكامل أمام المعلم
                    tableSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start",
                    });
                }, 800);
            });
        });
    </script>
@endsection
