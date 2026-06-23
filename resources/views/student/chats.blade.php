@extends('student.parent')
@section('title', 'الدردشة')
@section('content')
    <div class="">
        <div class="w-full bg-white dark:bg-slate-900 border border-gray-100 hover:border-teal-400 dark:border-slate-800/80 rounded-3xl shadow-md overflow-hidden text-xs mx-auto relative"
            dir="rtl">
            <div class="relative flex min-h-[650px] lg:min-h-[700px]">
                <div id="teachersDrawer"
                    class="hidden absolute md:static inset-y-0 right-0 z-40 w-72 md:w-80 bg-white dark:bg-slate-900 border-l border-gray-200 dark:border-slate-800 flex flex-col shadow-xl md:shadow-none">
                    <div
                        class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/50 dark:bg-slate-950/20">
                        <h3 class="font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                            <i class="fa-solid fa-graduation-cap text-teal-600"></i>
                            مراسلة معلمي المواد
                        </h3>
                        <button
                            onclick="
                    document
                      .getElementById('teachersDrawer')
                      .classList.add('hidden')
                  "
                            class="text-gray-400 hover:text-slate-600 dark:hover:text-zinc-200 p-1 cursor-pointer md:hidden">
                            <i class="fa-solid fa-xmark text-sm"></i>
                        </button>
                    </div>

                    <div class="p-3 border-b border-gray-50 dark:border-slate-800/60">
                        <div class="relative flex items-center">
                            <input type="text" placeholder="البحث عن معلم أو مادة..."
                                class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-slate-800 dark:text-zinc-100 rounded-xl py-2 pr-8 pl-3 outline-none focus:border-teal-500 text-[11px]" />
                            <i class="fa-solid fa-magnifying-glass absolute right-2.5 text-gray-400 text-[10px]"></i>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto divide-y divide-gray-100 dark:divide-slate-800/40">
                        <div onclick="
                    document
                      .getElementById('teachersDrawer')
                      .classList.add('hidden')
                  "
                            class="p-4 flex items-start gap-3 bg-teal-50/40 dark:bg-slate-900/40 border-r-4 border-teal-600 cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-800/30">
                            <div
                                class="w-8 h-8 rounded-xl bg-slate-800 dark:bg-slate-700 text-white font-black flex items-center justify-center text-xs shrink-0">
                                غ
                            </div>
                            <div class="flex-1 min-w-0 space-y-0.5">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800 dark:text-zinc-100">أ. غسان كنعان</span>
                                    <span class="text-[9px] text-gray-400">منذ 3 د</span>
                                </div>
                                <p class="text-[11px] text-teal-600 font-bold truncate">
                                    أ. غسان: وعليكم السلام ورحمة الله وبركاته يا أحمد...
                                </p>
                            </div>
                        </div>

                        <div onclick="
                    document
                      .getElementById('teachersDrawer')
                      .classList.add('hidden')
                  "
                            class="p-4 flex items-start gap-3 cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-800/30">
                            <div
                                class="w-8 h-8 rounded-xl bg-indigo-600 text-white font-black flex items-center justify-center text-xs shrink-0">
                                ر
                            </div>
                            <div class="flex-1 min-w-0 space-y-0.5">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800 dark:text-zinc-200">أ. رانيا عبد الله
                                        (اللغة العربية)</span>
                                    <span class="text-[9px] text-gray-400">أمس</span>
                                </div>
                                <p class="text-[11px] text-gray-400 truncate">
                                    تم استلام ورقة العمل وجاري التدقيق شكراً لالتزامك.
                                </p>
                            </div>
                            <span class="w-1.5 h-1.5 rounded-full bg-teal-500 self-center shrink-0"></span>
                        </div>
                    </div>
                </div>

                <div class="flex-1 flex flex-col bg-white dark:bg-slate-900 w-full">
                    <div
                        class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/30 dark:bg-slate-950/10">
                        <div class="flex items-center gap-3">
                            <button
                                onclick="
                      const drawer = document.getElementById('teachersDrawer');
                      drawer.classList.toggle('hidden');
                    "
                                title="فتح قائمة المعلمين"
                                class="bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-zinc-200 w-9 h-9 rounded-xl flex items-center justify-center hover:bg-teal-600 hover:text-white shadow-xs cursor-pointer shrink-0">
                                <i class="fa-solid fa-bars-staggered text-sm"></i>
                            </button>

                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-xl bg-slate-800 dark:bg-slate-700 text-white font-black flex items-center justify-center text-xs">
                                    غ
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-100">
                                        أ. غسان كنعان (معلم الرياضيات)
                                    </h4>
                                    <p class="text-[10px] text-teal-600 font-bold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        متصل الآن
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 text-gray-400">
                            <button class="hover:text-slate-600 dark:hover:text-zinc-200 cursor-pointer p-1"
                                title="مفردات المادة">
                                <i class="fa-solid fa-book-open text-base"></i>
                            </button>
                            <button class="hover:text-rose-600 cursor-pointer p-1">
                                <i class="fa-solid fa-ellipsis-vertical text-base"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex-1 p-5 overflow-y-auto space-y-4 bg-gray-50/30 dark:bg-slate-950/5 max-h-[500px]">
                        <div class="flex items-start gap-2.5 max-w-[85%]">
                            <div
                                class="w-6 h-6 rounded-lg bg-teal-600 text-white font-bold text-[10px] flex items-center justify-center shrink-0 shadow-xs">
                                أ
                            </div>
                            <div class="space-y-1">
                                <div
                                    class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-800 p-3 rounded-2xl rounded-tr-none shadow-xs text-slate-800 dark:text-zinc-100 leading-relaxed">
                                    السلام عليكم يا أستاذ غسان، واجهت مشكلة تقنية أثناء محاولة
                                    رفع ملف الـ PDF الخاص بواجب الرياضيات اليوم... هل يمكنني
                                    إرساله لك هنا مباشرة؟
                                </div>
                                <p class="text-[9px] text-gray-400 text-right mr-1">
                                    11:42 ص
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5 max-w-[85%] mr-auto flex-row-reverse">
                            <div
                                class="w-6 h-6 rounded-lg bg-slate-700 text-white font-bold text-[10px] flex items-center justify-center shrink-0 shadow-xs">
                                م
                            </div>
                            <div class="space-y-1">
                                <div
                                    class="bg-teal-600 text-white p-3 rounded-2xl rounded-tl-none shadow-xs leading-relaxed">
                                    وعليكم السلام ورحمة الله وبركاته يا أحمد. لا بأس، يمكنك
                                    إرفاق الملف هنا في هذه المحادثة وسأقوم بفحصه ورصد درجتك في
                                    النظام مباشرة.
                                </div>
                                <p class="text-[9px] text-gray-400 text-left ml-1">
                                    11:45 ص • تم القراءة
                                    <i class="fa-solid fa-check-double text-teal-400"></i>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-2.5 max-w-[85%]">
                            <div
                                class="w-6 h-6 rounded-lg bg-teal-600 text-white font-bold text-[10px] flex items-center justify-center shrink-0 shadow-xs">
                                أ
                            </div>
                            <div class="space-y-1">
                                <div
                                    class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-800 p-3 rounded-2xl rounded-tr-none shadow-xs space-y-2">
                                    <p class="text-slate-800 dark:text-zinc-100">
                                        أشكرك جزيل الشكر يا أستاذ، هذا هو ملف حل ورقة عمل
                                        المصفوفات:
                                    </p>

                                    <div
                                        class="p-2 border border-rose-100 dark:border-rose-950/40 bg-rose-50/40 dark:bg-rose-950/10 rounded-xl flex items-center justify-between gap-4">
                                        <div class="flex items-center gap-1.5 truncate">
                                            <i class="fa-solid fa-file-pdf text-rose-500 text-base"></i>
                                            <span
                                                class="font-bold text-slate-700 dark:text-zinc-300 truncate text-[11px]">math_matrices_homework.pdf</span>
                                        </div>
                                        <a href="#" target="_blank"
                                            class="text-[10px] bg-white dark:bg-slate-800 text-rose-600 border border-rose-200 dark:border-rose-900 px-2 py-1 rounded-lg font-black shrink-0 hover:bg-rose-50">معاينة</a>
                                    </div>
                                </div>
                                <p class="text-[9px] text-gray-400 text-right mr-1">
                                    11:46 ص
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 border-t border-gray-100 dark:border-slate-800 bg-white dark:bg-slate-900">
                        <form action="#" method="POST" onsubmit="event.preventDefault()"
                            class="flex items-center gap-2">
                            <div class="flex items-center text-gray-400 gap-1">
                                <button type="button" title="إرفاق ملف أو واجب"
                                    class="w-8 h-8 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 flex items-center justify-center cursor-pointer">
                                    <i class="fa-solid fa-paperclip text-sm"></i>
                                </button>
                                <button type="button"
                                    class="w-8 h-8 rounded-xl hover:bg-gray-100 dark:hover:bg-slate-800 flex items-center justify-center cursor-pointer">
                                    <i class="fa-solid fa-face-smile text-sm"></i>
                                </button>
                            </div>

                            <input type="text" placeholder="اكتب رسالتك أو استفسارك للأستاذ هنا..."
                                class="flex-1 bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 text-xs" />

                            <button type="submit"
                                class="bg-teal-600 hover:bg-teal-700 text-white w-9 h-9 rounded-xl flex items-center justify-center cursor-pointer shadow-xs shrink-0">
                                <i class="fa-solid fa-paper-plane text-xs transform -rotate-45 -mr-0.5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
