@extends('student.parent')
@section('title', 'المزامنة')
@section('content')
    <div class="w-full space-y-6 text-xs text-right" dir="rtl">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
            <div>
                <h3 class="font-black text-gray-700 dark:text-white text-base flex items-center gap-2">
                    <i class="fa-solid fa-rotate text-cyan-500 animate-spin-slow"></i>
                    قائمة المزامنة
                </h3>
                <p class="text-gray-700 dark:text-gray-400 text-[11px] mt-1">
                    إدارة البيانات المحفوظة محلياً في انتظار الاتصال بالشبكة
                </p>
            </div>

            <div class="flex items-center gap-2.5">
                <button onclick="triggerSync()"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white font-black px-4 py-2 rounded-xl shadow-md flex items-center gap-1.5 cursor-pointer">
                    <i class="fa-solid fa-cloud-arrow-up text-[10px]"></i> المزامنة
                    الآن
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 hover:border-teal-500 p-4 rounded-2xl text-center space-y-1">
                <p class="text-gray-700 dark:text-gray-400 font-semibold text-[13px]">
                    إجمالي العمليات
                </p>
                <p id="totalSyncCount" class="font-black text-xl text-cyan-400">
                    3
                </p>
            </div>
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 hover:border-teal-500 p-4 rounded-2xl text-center space-y-1">
                <p class="text-gray-700 dark:text-gray-400 font-semibold text-[13px]">
                    تمت المزامنة
                </p>
                <p id="successSyncCount" class="font-black text-xl text-emerald-400">
                    2
                </p>
            </div>
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 hover:border-teal-500 p-4 rounded-2xl text-center space-y-1">
                <p class="text-gray-700 dark:text-gray-400 font-semibold text-[13px]">
                    في انتظار المزامنة
                </p>
                <p id="pendingSyncCount" class="font-black text-xl text-amber-500">
                    1
                </p>
            </div>
        </div>

        <div class="space-y-3">
            <h4 class="font-black text-amber-500 px-1 flex items-center gap-1.5">
                <i class="fa-solid fa-hourglass-start text-[11px]"></i> في انتظار
                المزامنة (<span id="pendingLabelCount">1</span>)
            </h4>

            <div id="pendingContainer" class="space-y-2.5">
                <div id="pendingItem-1"
                    class="bg-white dark:bg-slate-900/60 border border-amber-500/20 p-4 rounded-2xl flex items-center justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-xl bg-amber-950/60 text-amber-500 border border-amber-500/20 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-file-signature text-xs"></i>
                        </div>
                        <div class="space-y-1">
                            <h5 class="font-bold text-gray-700 dark:text-white">
                                نتيجة اختبار: اختبار العلوم - الكيمياء الأساسية (3/4)
                            </h5>
                            <p class="text-[11px] text-gray-600 dark:text-gray-400">
                                تم الحفظ محلياً: 2026-06-19 • 03:15 م
                            </p>
                        </div>
                    </div>
                    <span
                        class="bg-amber-950/80 text-amber-500 border border-amber-500/20 text-[9px] font-black px-2 py-1 rounded-lg shrink-0">
                        بانتظار شبكة
                        <i class="fa-solid fa-wifi-slash mr-0.5 text-[8px]"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <h4 class="font-black text-emerald-400 px-1 flex items-center gap-1.5">
                <i class="fa-solid fa-circle-check text-[11px]"></i> تمت مزامنتها
                (<span id="successLabelCount">2</span>)
            </h4>

            <div class="space-y-2.5">
                <div
                    class="bg-white dark:bg-slate-900/40 border border-slate-400 p-4 rounded-2xl flex items-center justify-between gap-4 opacity-85">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-square-poll-vertical text-xs"></i>
                        </div>
                        <div class="space-y-1">
                            <h5 class="font-bold text-gray-700 dark:text-white">
                                نتيجة اختبار: اختبار التربية الإسلامية (2/3)
                            </h5>
                            <p class="text-[11px] text-gray-600 dark:text-gray-400">
                                تمت المزامنة: 2026-06-15 • 02:44 م
                            </p>
                        </div>
                    </div>
                    <span
                        class="bg-emerald-100 text-emerald-400 border border-emerald-500/20 text-[9px] font-bold px-2 py-1 rounded-lg shrink-0">
                        تمت المزامنة <i class="fa-solid fa-check text-[8px]"></i>
                    </span>
                </div>

                <div
                    class="bg-white dark:bg-slate-900/40 border border-slate-400 p-4 rounded-2xl flex items-center justify-between gap-4 opacity-85">
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-400 flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-envelope text-xs"></i>
                        </div>
                        <div class="space-y-1">
                            <h5 class="font-bold text-gray-700 dark:text-white">
                                رسالة جديدة مبعوثة للأستاذ: ورقة عمل الرياضيات
                            </h5>
                            <p class="text-[10px] text-gray-500">
                                تمت المزامنة: 2026-06-15 • 02:54 م
                            </p>
                        </div>
                    </div>
                    <span
                        class="bg-emerald-100 text-emerald-400 border border-emerald-500/20 text-[9px] font-bold px-2 py-1 rounded-lg shrink-0">
                        تمت المزامنة <i class="fa-solid fa-check text-[8px]"></i>
                    </span>
                </div>
            </div>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 hover:border-teal-500 rounded-2xl p-4 space-y-4">
            <h4 class="font-black text-gray-700 dark:text-white flex items-center gap-1.5">
                <i class="fa-solid fa-database text-cyan-500 text-[11px]"></i> إدارة
                البيانات المحلية
            </h4>

            <div
                class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-3 bg-slate-900 border border-slate-800 rounded-xl">
                <div class="space-y-0.5">
                    <p class="font-bold text-zinc-300 text-xs">
                        حجم البيانات المخزنة محلياً
                    </p>
                    <p class="text-[10px] text-gray-400">
                        تشمل الكاش المؤقت للاختبارات، التوصيفات، والنصوص المكتوبة
                        غيابياً
                    </p>
                </div>
                <div
                    class="font-black text-zinc-100 text-sm dir-ltr bg-slate-950 px-3 py-1.5 rounded-lg border border-slate-800">
                    74.8 KB
                </div>
            </div>

            <button
                class="w-full bg-rose-100 dark:bg-rose-950/40 hover:bg-rose-700/70 hover:text-white text-rose-400 border border-rose-900/50 font-black py-3 rounded-xl shadow-xs cursor-pointer text-center flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-trash-can text-[11px]"></i> مسح جميع البيانات
                المحلية وإعادة المزامنة الصفرية
            </button>
        </div>
    </div>
@endsection
