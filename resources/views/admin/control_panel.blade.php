@extends('admin.parent')

@section('title', 'نظرة عامة')

@section('content')
    {{-- Main Content --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-8">
        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">إجمالي الطلاب</span>
                    <span class="text-sm text-teal-600 dark:text-teal-400 font-semibold">20 نشط</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-blue-50 dark:bg-blue-950/40 flex items-center justify-center text-blue-600 dark:text-blue-400 shadow-sm">
                    <i class="fa-solid fa-graduation-cap text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-zinc-100">
                    20
                </h3>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">إجمالي المعلمين</span>
                    <span class="text-sm text-blue-600 dark:text-blue-400 font-semibold">5 نشط</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-sm">
                    <i class="fa-solid fa-chalkboard-user text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-zinc-100">
                    5
                </h3>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-amber-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">الرسوم المحصلة</span>
                    <span class="text-sm text-slate-700 dark:text-zinc-400 font-semibold">إجمالي</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center text-amber-600 dark:text-amber-400 shadow-sm">
                    <i class="fa-solid fa-money-bill-wave text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4 flex items-baseline gap-1 justify-start dir-rtl">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-zinc-100">
                    11,100
                </h3>
                <span class="text-sm font-semibold text-gray-500 dark:text-zinc-400">₪</span>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-rose-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">الرصيد المتبقي</span>
                    <span class="text-sm text-rose-600 dark:text-rose-400 font-semibold">مستحق التحصيل</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-950/40 flex items-center justify-center text-rose-600 dark:text-rose-400 shadow-sm">
                    <i class="fa-solid fa-hand-holding-dollar text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4 flex items-baseline gap-1 justify-start dir-rtl">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-zinc-100">
                    3,900
                </h3>
                <span class="text-sm font-semibold text-gray-500 dark:text-zinc-400">₪</span>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-orange-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">طلاب عليهم مستحقات</span>
                    <span class="text-sm text-orange-600 dark:text-orange-400 font-semibold">يحتاج متابعة</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-orange-50 dark:bg-orange-950/40 flex items-center justify-center text-orange-600 dark:text-orange-400 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-zinc-100">
                    8
                </h3>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">مسددون بالكامل</span>
                    <span class="text-sm text-emerald-600 dark:text-emerald-400 font-semibold">حالة جيدة</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-sm">
                    <i class="fa-solid fa-square-check text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-zinc-100">
                    13
                </h3>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-indigo-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">متوسط الحضور</span>
                    <span class="text-sm text-indigo-600 dark:text-indigo-400 font-semibold">معدل عام</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 shadow-sm">
                    <i class="fa-solid fa-chart-simple text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4">
                <h3 class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                    88%
                </h3>
            </div>
        </div>

        <div
            class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
            <div
                class="absolute -top-10 -left-10 w-28 h-28 bg-purple-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
            </div>
            <div class="flex justify-between items-start">
                <div class="flex flex-col gap-1 text-right">
                    <span class="text-xs font-bold text-slate-700 dark:text-zinc-400">متوسط العلامات</span>
                    <span class="text-sm text-purple-600 dark:text-purple-400 font-semibold">أداء أكاديمي</span>
                </div>
                <div
                    class="w-10 h-10 rounded-xl bg-purple-50 dark:bg-purple-950/40 flex items-center justify-center text-purple-600 dark:text-purple-400 shadow-sm">
                    <i class="fa-solid fa-bullseye text-lg"></i>
                </div>
            </div>
            <div class="text-right mt-4">
                <h3 class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                    83%
                </h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6 items-stretch">
        <div
            class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div class="w-full">
                <h3 class="text-base font-bold text-slate-800 dark:text-zinc-100 text-right mb-5">
                    <span>توزيع الطلاب على الصفوف</span>
                </h3>

                <div class="flex flex-row flex-wrap gap-4 justify-end dir-rtl">
                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الأول
                            الابتدائي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">12 طالب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 75%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-teal-50/30 dark:bg-slate-800/60 border border-teal-200 dark:border-slate-700 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center ring-1 ring-teal-500/30 shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الثاني
                            الإبتدائي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">20 طالب</span>
                        </div>
                        <span class="text-[10px] text-teal-600 dark:text-teal-400 mt-2 font-bold">نسبة كاملة</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الثالث
                            الابتدائي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">15 طالب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 90%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الرابع
                            الابتدائي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">8 طلاب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 45%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-teal-50/30 dark:bg-slate-800/60 border border-teal-200 dark:border-slate-700 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center ring-1 ring-teal-500/30 shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الخامس
                            الإبتدائي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">20 طالب</span>
                        </div>
                        <span class="text-[10px] text-teal-600 dark:text-teal-400 mt-2 font-bold">نسبة كاملة</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">السادس
                            الابتدائي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">14 طالب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 82%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">السابع
                            الأساسي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">9 طلاب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 52%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الثامن
                            الأساسي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">7 طلاب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 40%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-teal-50/30 dark:bg-slate-800/60 border border-teal-200 dark:border-slate-700 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center ring-1 ring-teal-500/30 shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">التاسع
                            الأساسي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">20 طالب</span>
                        </div>
                        <span class="text-[10px] text-teal-600 dark:text-teal-400 mt-2 font-bold">نسبة كاملة</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">العاشر
                            الأساسي</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">16 طالب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 95%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100 dark:border-slate-800 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">الحادي عشر</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">6 طلاب</span>
                        </div>
                        <span class="text-[10px] text-gray-400 dark:text-zinc-400 mt-2 font-medium">نسبة 35%</span>
                    </div>

                    <div
                        class="flex flex-col items-center p-4 bg-teal-50/30 dark:bg-slate-800/60 border border-teal-200 dark:border-slate-700 rounded-xl flex-1 min-w-[110px] max-w-[140px] text-center ring-1 ring-teal-500/30 shadow-sm">
                        <span class="text-xs font-bold text-slate-700 dark:text-zinc-400 mb-2">التوجيهي 🎓</span>
                        <div
                            class="relative w-14 h-14 flex items-center justify-center rounded-full bg-teal-50 dark:bg-slate-800 ring-4 ring-teal-600/20">
                            <span class="text-xs font-black text-teal-700 dark:text-teal-400">20 طالب</span>
                        </div>
                        <span class="text-[10px] text-teal-600 dark:text-teal-400 mt-2 font-bold">نسبة كاملة</span>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div class="w-full">
                <h3 class="text-base font-bold text-slate-800 dark:text-zinc-100 text-right mb-5">
                    إجراءات سريعة
                </h3>
                <div class="flex flex-col gap-3 justify-start">
                    <a href="students.html"
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 hover:bg-gray-50 hover:border-teal-200 dark:hover:border-slate-700 dark:bg-slate-800/40 dark:hover:bg-slate-800 border border-gray-100/70 dark:border-slate-800 rounded-xl active:scale-[0.98] group">
                        <div
                            class="w-9 h-9 rounded-lg bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 shadow-sm group-hover:scale-105">
                            <i class="fa-solid fa-graduation-cap text-base"></i>
                        </div>
                        <div class="text-right flex-1 pr-3">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                دليل الطلاب
                            </h4>
                            <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                عرض وتعديل بيانات الطلاب
                            </p>
                        </div>
                    </a>

                    <a href="teachers.html"
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 hover:bg-gray-50 hover:border-teal-200 dark:hover:border-slate-700 dark:bg-slate-800/40 dark:hover:bg-slate-800 border border-gray-100/70 dark:border-slate-800 rounded-xl active:scale-[0.98] group">
                        <div
                            class="w-9 h-9 rounded-lg bg-blue-50 dark:bg-blue-950/40 flex items-center justify-center text-blue-600 dark:text-blue-400 shadow-sm group-hover:scale-105">
                            <i class="fa-solid fa-chalkboard-user text-base"></i>
                        </div>
                        <div class="text-right flex-1 pr-3">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                إدارة المعلمين
                            </h4>
                            <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                إضافة معلم جديد
                            </p>
                        </div>
                    </a>

                    <a href="fees.html"
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 hover:bg-gray-50 hover:border-teal-200 dark:hover:border-slate-700 dark:bg-slate-800/40 dark:hover:bg-slate-800 border border-gray-100/70 dark:border-slate-800 rounded-xl active:scale-[0.98] group">
                        <div
                            class="w-9 h-9 rounded-lg bg-amber-50 dark:bg-amber-950/40 flex items-center justify-center text-amber-600 dark:text-amber-400 shadow-sm group-hover:scale-105">
                            <i class="fa-solid fa-hand-holding-dollar text-base"></i>
                        </div>
                        <div class="text-right flex-1 pr-3">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                تسجيل دفعة
                            </h4>
                            <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                تسجيل رسوم الطلاب
                            </p>
                        </div>
                    </a>

                    <a href="role_permistions.html"
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 hover:bg-gray-50 hover:border-teal-200 dark:hover:border-slate-700 dark:bg-slate-800/40 dark:hover:bg-slate-800 border border-gray-100/70 dark:border-slate-800 rounded-xl active:scale-[0.98] group">
                        <div
                            class="w-9 h-9 rounded-lg bg-purple-50 dark:bg-purple-950/40 flex items-center justify-center text-purple-600 dark:text-purple-400 shadow-sm group-hover:scale-105">
                            <i class="fa-solid fa-shield-halved text-base"></i>
                        </div>
                        <div class="text-right flex-1 pr-3">
                            <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                الصلاحيات
                            </h4>
                            <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                إدارة الأدوار والوصول
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6 items-stretch dir-rtl">
        <div
            class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div class="w-full">
                <h3 class="text-base font-bold text-slate-800 dark:text-zinc-100 text-right mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-bell text-teal-600 dark:text-teal-400 text-sm"></i>
                    <span>آخر الإشعارات والمدفوعات</span>
                </h3>

                <div class="flex flex-col gap-3">
                    <div
                        class="flex items-center justify-between p-3 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <div class="text-right flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 text-xs">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                    تمت إضافة الطالب أحمد محمود الخالدي
                                </h4>
                                <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                    الصف السابع الابتدائي
                                </p>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-gray-400 dark:text-zinc-500">الآن</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <div class="text-right flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                    محمد سامي العلي
                                </h4>
                                <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                    محفظة
                                </p>
                            </div>
                        </div>
                        <span class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-1">
                            <span class="text-xs font-bold text-gray-400 dark:text-zinc-500">₪</span>
                            300
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <div class="text-right flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 text-xs">
                                <i class="fa-solid fa-user-plus"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                    تمت إضافة الطالبة ياسمين رائد النجار
                                </h4>
                                <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                    الصف الأول الابتدائي
                                </p>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-gray-400 dark:text-zinc-500">قبل ٥ د</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <div class="text-right flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                    يوسف عمر البكري
                                </h4>
                                <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                    تحويل بنكي
                                </p>
                            </div>
                        </div>
                        <span class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-1">
                            <span class="text-xs font-bold text-gray-400 dark:text-zinc-500">₪</span>
                            500
                        </span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <div class="text-right flex items-center gap-3">
                            <div
                                class="w-8 h-8 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-xs">
                                <i class="fa-solid fa-wallet"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800 dark:text-zinc-200">
                                    مريم أحمد يوسف
                                </h4>
                                <p class="text-xs text-gray-400 dark:text-zinc-400 mt-0.5">
                                    نقداً
                                </p>
                            </div>
                        </div>
                        <span class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-1">
                            <span class="text-xs font-bold text-gray-400 dark:text-zinc-500">₪</span>
                            800
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">
            <div class="w-full">
                <h3 class="text-base font-bold text-slate-800 dark:text-zinc-100 text-right mb-5 flex items-center gap-2">
                    <i class="fa-solid fa-server text-blue-600 dark:text-blue-400 text-sm"></i>
                    <span>حالة النظام</span>
                </h3>

                <div class="flex flex-col gap-3">
                    <div
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <span class="text-sm font-bold text-slate-700 dark:text-zinc-300">المستخدمون النشطون</span>
                        <span
                            class="text-sm font-black text-slate-800 dark:text-zinc-100 bg-gray-100 dark:bg-slate-800 px-2.5 py-1 rounded-md">27</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <span class="text-sm font-bold text-slate-700 dark:text-zinc-300">إجمالي المواد</span>
                        <span
                            class="text-sm font-black text-slate-800 dark:text-zinc-100 bg-gray-100 dark:bg-slate-800 px-2.5 py-1 rounded-md">5</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <span class="text-sm font-bold text-slate-700 dark:text-zinc-300">الاختبارات المتاحة</span>
                        <span
                            class="text-sm font-black text-slate-800 dark:text-zinc-100 bg-gray-100 dark:bg-slate-800 px-2.5 py-1 rounded-md">5</span>
                    </div>

                    <div
                        class="flex items-center justify-between p-3.5 bg-gray-50/50 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 rounded-xl">
                        <span class="text-sm font-bold text-slate-700 dark:text-zinc-300">قائمة انتظار
                            المزامنة</span>
                        <span
                            class="text-sm font-black text-teal-600 dark:text-teal-400 bg-teal-50 dark:bg-teal-950/30 px-2.5 py-1 rounded-md font-bold">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
