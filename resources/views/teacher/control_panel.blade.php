@extends('teacher.parent')
@section('title', 'نظرة عامة')
@section('content')
    <div class="w-full space-y-6 my-6 text-xs" dir="rtl">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">إجمالي الطلاب</span>
                        <span class="text-sm text-teal-600 dark:text-teal-400 font-semibold">12 طالب</span>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 shadow-sm">
                        <i class="fa-solid fa-users text-lg"></i>
                    </div>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">بانتظار التصحيح</span>
                        <p class="text-xl font-black text-rose-500">
                            5
                            <span class="text-[13px] text-slate-600 dark:text-gray-400 font-normal">ملفات</span>
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-rose-50 dark:bg-rose-955 flex items-center justify-center text-rose-500 shadow-sm">
                        <i class="fa-solid fa-clock-rotate-left text-lg"></i>
                    </div>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">الواجبات المنشورة</span>
                        <p class="text-xl font-black text-indigo-500">
                            8
                            <span class="text-[13px] text-slate-600 dark:text-gray-400 font-normal">واجبات</span>
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-indigo-500 shadow-sm">
                        <i class="fa-solid fa-book text-lg"></i>
                    </div>
                </div>
            </div>

            <div
                class="relative overflow-hidden bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl p-6 shadow-sm hover:shadow-md flex flex-col justify-between min-h-[140px]">
                <div
                    class="absolute -top-10 -left-10 w-28 h-28 bg-blue-500/10 rounded-full blur-2xl pointer-events-none hidden dark:block">
                </div>
                <div class="flex justify-between mt-4 items-start">
                    <div class="flex flex-col gap-1 text-right">
                        <span class="text-xs font-bold text-slate-700 dark:text-white">الرسائل غير المقروءة</span>
                        <p class="text-xl font-black text-teal-600">
                            2
                            <span class="text-[13px] text-slate-600 dark:text-gray-400 font-normal">رسائل</span>
                        </p>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 flex items-center justify-center text-emerald-600 shadow-sm">
                        <i class="fa-solid fa-envelope-open-text text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm flex flex-col justify-between space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                            🏫 الصفوف الدراسية الخاصة بي
                        </h3>
                        <p class="text-[10px] text-slate-500 dark:text-gray-400 font-medium">
                            قائمة بالفصول التي تقوم بتدريسها حالياً وإحصاء سريع لعدد
                            الطلاب المضافين
                        </p>
                    </div>
                    <span
                        class="bg-indigo-50 dark:bg-indigo-950/50 text-indigo-600 font-bold px-2.5 py-1 rounded-full text-[10px]">
                        إجمالي: 3 فصول
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                    <div
                        class="p-4 border border-gray-100 dark:border-slate-800/80 bg-gray-50/30 dark:bg-slate-950/20 rounded-2xl flex flex-col justify-between space-y-3 hover:border-teal-500 ">
                        <div class="space-y-1">
                            <div
                                class="w-7 h-7 rounded-lg bg-teal-600/10 text-teal-600 flex items-center justify-center font-black">
                                ١
                            </div>
                            <h4 class="font-bold text-slate-800 dark:text-zinc-200 text-xs pt-1">
                                الصف الأول الإعدادي
                            </h4>
                            <p class="text-[10px] text-slate-600 dark:text-gray-400">
                                مادة اللغة العربية (أ)
                            </p>
                        </div>
                        <div
                            class="pt-2 border-t border-gray-100 dark:border-slate-800/40 flex items-center justify-between">
                            <span class="text-slate-600 dark:text-gray-400 text-[10px]">عدد الطلاب:</span>
                            <span
                                class="font-black text-slate-800 dark:text-zinc-100 text-xs bg-white dark:bg-slate-900 px-2 py-0.5 rounded-md border border-gray-200 dark:border-slate-800">24
                                طالباً</span>
                        </div>
                    </div>

                    <div
                        class="p-4 border border-gray-100 dark:border-slate-800/80 bg-gray-50/30 dark:bg-slate-950/20 rounded-2xl flex flex-col justify-between space-y-3 hover:border-teal-500 ">
                        <div class="space-y-1">
                            <div
                                class="w-7 h-7 rounded-lg bg-indigo-600/10 text-indigo-600 flex items-center justify-center font-black">
                                ٢
                            </div>
                            <h4 class="font-bold text-slate-800 dark:text-zinc-200 text-xs pt-1">
                                الصف الثاني الإعدادي
                            </h4>
                            <p class="text-[10px] text-slate-600 dark:text-gray-400">
                                مادة اللغة العربية (ب)
                            </p>
                        </div>
                        <div
                            class="pt-2 border-t border-gray-100 dark:border-slate-800/40 flex items-center justify-between">
                            <span class="text-slate-600 dark:text-gray-400 text-[10px]">عدد الطلاب:</span>
                            <span
                                class="font-black text-slate-800 dark:text-zinc-100 text-xs bg-white dark:bg-slate-900 px-2 py-0.5 rounded-md border border-gray-200 dark:border-slate-800">18
                                طالباً</span>
                        </div>
                    </div>

                    <div
                        class="p-4 border border-gray-100 dark:border-slate-800/80 bg-gray-50/30 dark:bg-slate-950/20 rounded-2xl flex flex-col justify-between space-y-3 hover:border-teal-500 ">
                        <div class="space-y-1">
                            <div
                                class="w-7 h-7 rounded-lg bg-amber-600/10 text-amber-600 flex items-center justify-center font-black">
                                ٣
                            </div>
                            <h4 class="font-bold text-slate-800 dark:text-zinc-200 text-xs pt-1">
                                الصف الثالث الإعدادي
                            </h4>
                            <p class="text-[10px] text-slate-600 dark:text-gray-400">
                                مادة البلاغة والنصوص
                            </p>
                        </div>
                        <div
                            class="pt-2 border-t border-gray-100 dark:border-slate-800/40 flex items-center justify-between">
                            <span class="text-slate-600 dark:text-gray-400 text-[10px]">عدد الطلاب:</span>
                            <span
                                class="font-black text-slate-800 dark:text-zinc-100 text-xs bg-white dark:bg-slate-900 px-2 py-0.5 rounded-md border border-gray-200 dark:border-slate-800 animate-puls">6
                                طلاب</span>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm flex flex-col space-y-4">
                <div>
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                        🔔 آخر التفاعلات والأنشطة
                    </h3>
                    <p class="text-[10px] text-slate-500 dark:text-gray-400 font-medium">
                        متابعة حية للعمليات الأخيرة داخل نظامك
                    </p>
                </div>

                <div class="flex-1 space-y-4 overflow-y-auto max-h-[220px] pr-1">
                    <div class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-teal-500 mt-1.5 shrink-0"></span>
                        <div class="space-y-0.5">
                            <p class="text-slate-800 dark:text-zinc-200 font-bold">
                                قام الطالب <span class="text-teal-600">أحمد محمد</span> برفع
                                واجب النحو
                            </p>
                            <p class="text-[9px] text-gray-400">منذ 5 دقائق</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                        <div class="space-y-0.5">
                            <p class="text-slate-800 dark:text-zinc-200 font-medium">
                                رسالة جديدة واردة من الطالبة
                                <span class="text-amber-600">سارة عبد الله</span>
                            </p>
                            <p class="text-[9px] text-gray-400">منذ ساعة</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="w-2 h-2 rounded-full bg-indigo-500 mt-1.5 shrink-0"></span>
                        <div class="space-y-0.5">
                            <p class="text-slate-800 dark:text-zinc-300">
                                أضفت واجباً جديداً: "بلاغة الجناس والطباق"
                            </p>
                            <p class="text-[9px] text-gray-400">أمس، 4:30 م</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm space-y-4">
            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs flex items-center gap-2">
                    <span class="w-1.5 h-3 bg-teal-600 rounded-full"></span> الواجبات
                    المفعّلة حالياً بالجدول
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse text-xs">
                    <thead>
                        <tr
                            class="border-b border-gray-100 dark:border-slate-800 text-slate-600 dark:text-gray-400 font-bold">
                            <th class="pb-3 pl-4">اسم الواجب الدراسي</th>
                            <th class="pb-3 px-4">الصف الدراسي</th>
                            <th class="pb-3 px-4">حالة التسليمات</th>
                            <th class="pb-3 pr-4">التاريخ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60 text-slate-700 dark:text-zinc-300">
                        <tr class="hover:bg-gray-50/40 dark:hover:bg-slate-950/20 ">
                            <td class="py-3.5 pl-4 font-bold text-slate-800 dark:text-zinc-100">
                                واجب النحو: الفاعل والمفعول به
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 dark:text-gray-400">
                                الصف الأول الإعدادي
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="bg-teal-50 text-teal-600 dark:bg-teal-950/40 px-2 rounded font-bold">2
                                    طلاب سلّموا</span>
                            </td>
                            <td class="py-3.5 pr-4 text-slate-600 dark:text-gray-400 font-medium">
                                18 يونيو 2026
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50/40 dark:hover:bg-slate-950/20 ">
                            <td class="py-3.5 pl-4 font-bold text-slate-800 dark:text-zinc-100">
                                واجب النصوص: قصيدة أحمد شوقي
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 dark:text-gray-400">
                                الصف الثاني الإعدادي
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="bg-gray-100 dark:bg-slate-800 text-gray-500 px-2 py-0.5 rounded">0
                                    تسليمات حتى الآن</span>
                            </td>
                            <td class="py-3.5 pr-4 text-slate-600 dark:text-gray-400 font-medium">
                                15 يونيو 2026
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
