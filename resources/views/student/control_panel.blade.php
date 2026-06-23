@extends('student.parent')
@section('title', 'الرئيسية')
@section('content')
    <div
        class="w-full bg-teal-600 rounded-3xl p-6 text-white flex flex-col md:flex-row items-center justify-between gap-6 shadow-sm">
        <div class="flex items-center gap-4">
            <div
                class="w-16 h-16 bg-white/20 border-2 border-white/30 rounded-full flex items-center justify-center text-2xl font-black shadow-inner">
                م
            </div>
            <div class="space-y-1 text-center md:text-right">
                <h2 class="text-base font-black">مريم أحمد يوسف</h2>
                <p class="text-white/80 font-medium text-[11px]">
                    STU-2024-001 • الصف الأول الثانوي
                </p>
                <div class="flex items-center justify-center md:justify-start gap-1.5 pt-1 flex-wrap">
                    <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-md">✓ نشط</span>
                    <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-md">مدفوع</span>
                    <span class="bg-white/20 text-white text-[10px] font-bold px-2 py-0.5 rounded-md">96%
                        حضور</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-teal-400 dark:border-slate-700 hover:shadow-lg p-4 rounded-2xl shadow-3xs text-center space-y-1">
            <div class="flex justify-center">
                <i class="fa-solid fa-chart-simple text-teal-500 text-base"></i>
            </div>
            <p class="text-teal-400 font-bold text-[11px]">
                المعدل العام
            </p>
            <p class="text-teal-600 dark:text-teal-400 text-lg font-black">
                92%
            </p>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-teal-400 dark:border-slate-700 hover:shadow-lg p-4 rounded-2xl shadow-3xs text-center space-y-1">
            <div class="flex justify-center">
                <i class="fa-solid fa-circle-check text-blue-500 text-base"></i>
            </div>
            <p class="text-blue-600 font-bold text-[11px]">
                نسبة الحضور
            </p>
            <p class="text-blue-600 dark:text-blue-400 text-lg font-black">
                96%
            </p>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-teal-400 dark:border-slate-700 hover:shadow-lg p-4 rounded-2xl shadow-3xs text-center space-y-1">
            <div class="flex justify-center">
                <i class="fa-solid fa-pen-to-square text-orange-500 text-base"></i>
            </div>
            <p class="text-orange-600 font-bold text-[11px]">
                اختبارات منجزة
            </p>
            <p class="text-orange-600 dark:text-orange-400 text-lg font-black">
                5
            </p>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-teal-400 dark:border-slate-700 hover:shadow-lg p-4 rounded-2xl shadow-3xs text-center space-y-1">
            <div class="flex justify-center">
                <i class="fa-solid fa-wallet text-amber-500 text-base"></i>
            </div>
            <p class="text-amber-400 font-bold text-[11px]">
                الرسوم المستحقة
            </p>
            <p class="text-amber-600 text-lg font-black">
                0
                <span class="text-[10px] text-amber-400 font-normal">₪</span>
            </p>
        </div>
    </div>

    <div
        class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-teal-400 dark:border-slate-700 hover:shadow-lg p-5 rounded-2xl shadow-3xs space-y-2">
        <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs flex items-center gap-1.5">
            <span>☀️ مرحباً بكِ في منصة صمود التعليمية</span>
        </h3>
        <p class="text-gray-400 dark:text-zinc-400 font-medium text-[11px] leading-relaxed">
            منصة تعليمية متكاملة مصممة خصيصاً لبيئات الأزمات. يمكنك
            متابعة دروسك وإجراء الاختبارات والتفاعل مع المعلمين حتى في
            حال انقطاع الإنترنت. سيتم حفظ كل ما تفعلينه محلياً ومزامنته
            تلقائياً عند توفر الاتصال.
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="space-y-3">
            <h4 class="font-black text-slate-800 dark:text-zinc-200 px-1 flex items-center gap-1.5 text-xs">
                <span>📊 آخر النتائج</span>
            </h4>
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-teal-400 dark:border-slate-700 p-4 rounded-2xl shadow-3xs space-y-2.5">
                <div
                    class="flex items-center justify-between p-2.5 bg-gray-50 dark:bg-slate-950/40 rounded-xl border border-gray-100/50 dark:border-slate-800/50">
                    <span class="font-bold text-slate-700 dark:text-zinc-300">اختبار التربية الإسلامية</span>
                    <span
                        class="bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-black px-2 py-0.5 rounded-lg text-[10px]">2/3</span>
                </div>

                <div
                    class="flex items-center justify-between p-2.5 bg-gray-50 dark:bg-slate-950/40 rounded-xl border border-gray-100/50 dark:border-slate-800/50">
                    <span class="font-bold text-slate-700 dark:text-zinc-300">اختبار اللغة الإنجليزية -
                        القواعد</span>
                    <span
                        class="bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 font-black px-2 py-0.5 rounded-lg text-[10px]">4/4</span>
                </div>

                <div
                    class="flex items-center justify-between p-2.5 bg-gray-50 dark:bg-slate-950/40 rounded-xl border border-gray-100/50 dark:border-slate-800/50">
                    <span class="font-bold text-slate-700 dark:text-zinc-300">اختبار العلوم - الكيمياء
                        الأساسية</span>
                    <span
                        class="bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-black px-2 py-0.5 rounded-lg text-[10px]">2/4</span>
                </div>

                <div
                    class="flex items-center justify-between p-2.5 bg-gray-50 dark:bg-slate-950/40 rounded-xl border border-gray-100/50 dark:border-slate-800/50">
                    <span class="font-bold text-slate-700 dark:text-zinc-300">اختبار اللغة العربية - الإعراب</span>
                    <span
                        class="bg-amber-100 text-amber-800 dark:bg-amber-950/60 dark:text-amber-400 font-black px-2 py-0.5 rounded-lg text-[10px]">3/4</span>
                </div>

                <div
                    class="flex items-center justify-between p-2.5 bg-gray-50 dark:bg-slate-950/40 rounded-xl border border-gray-100/50 dark:border-slate-800/50">
                    <span class="font-bold text-slate-700 dark:text-zinc-300">اختبار الرياضيات - الفصل الأول</span>
                    <span
                        class="bg-emerald-100 text-emerald-800 dark:bg-emerald-950/60 dark:text-emerald-400 font-black px-2 py-0.5 rounded-lg text-[10px]">5/5</span>
                </div>
            </div>
        </div>

        <div class="space-y-3">
            <h4 class="font-black text-slate-800 dark:text-zinc-200 px-1 flex items-center gap-1.5 text-xs">
                <span>📢 إعلانات حديثة</span>
            </h4>
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-teal-400 dark:border-slate-700 p-4 rounded-2xl shadow-3xs space-y-3">
                <div
                    class="p-3 bg-gray-50 dark:bg-slate-950/40 border border-gray-100 dark:border-slate-700 rounded-xl space-y-1">
                    <div class="flex items-center justify-between">
                        <h5 class="font-black text-slate-800 dark:text-zinc-200">
                            تأجيل الاختبار
                        </h5>
                        <span
                            class="bg-rose-50 text-rose-600 dark:bg-rose-950/50 dark:text-rose-400 font-bold px-1.5 py-0.5 rounded text-[9px]">مهم</span>
                    </div>
                    <p class="text-gray-400 text-[10px]">
                        تم تأجيل اختبار الرياضيات إلى يوم الأحد القادم.
                    </p>
                    <p class="text-gray-400 font-bold text-[9px] pt-1">
                        2024-10-18 • الأستاذ خالد النجار
                    </p>
                </div>

                <div
                    class="p-3 bg-gray-50 dark:bg-slate-950/40 border border-gray-100 dark:border-slate-700 rounded-xl space-y-1">
                    <div class="flex items-center justify-between">
                        <h5 class="font-black text-slate-800 dark:text-zinc-200">
                            موضوع التعبير الجديد
                        </h5>
                        <span
                            class="bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-400 font-bold px-1.5 py-0.5 rounded text-[9px]">عادي</span>
                    </div>
                    <p class="text-gray-400 text-[10px]">
                        يرجى إعداد موضوع تعبير عن "وطني" وتسليمه الأسبوع
                        القادم.
                    </p>
                    <p class="text-gray-400 font-bold text-[9px] pt-1">
                        2024-10-15 • الأستاذة سارة الدهان
                    </p>
                </div>

                <div
                    class="p-3 bg-gray-50 dark:bg-slate-950/40 border border-gray-100 dark:border-slate-700 rounded-xl space-y-1">
                    <div class="flex items-center justify-between">
                        <h5 class="font-black text-slate-800 dark:text-zinc-200">
                            تجربة مخبرية يوم الخميس
                        </h5>
                        <span
                            class="bg-blue-50 text-blue-600 dark:bg-blue-950/50 dark:text-blue-400 font-bold px-1.5 py-0.5 rounded text-[9px]">عادي</span>
                    </div>
                    <p class="text-gray-400 text-[10px]">
                        سنقوم بتجربة بسيطة عن الماء يوم الخميس الساعة 10
                        صباحاً.
                    </p>
                    <p class="text-gray-400 font-bold text-[9px] pt-1">
                        2024-10-20 • الأستاذ يوسف العامري
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
