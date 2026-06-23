@extends('teacher.parent')
@section('title', 'الحضور')
@section('content')
    <div class="mx-auto my-6 space-y-6" dir="rtl">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-4 flex-1 justify-start">
                <div class="w-full sm:w-64">
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 mb-1">الصف</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:border-emerald-600 cursor-pointer">
                        <option value="1">الصف الأول الإعدادي</option>
                        <option value="2">الصف الثاني الإعدادي</option>
                        <option value="3">الصف الثالث الإعدادي</option>
                    </select>
                </div>
                <div class="w-full sm:w-48">
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 mb-1">التاريخ</label>
                    <input type="date" value="2026-06-18"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:outline-none focus:ring-2 focus:ring-teal-600" />
                </div>
            </div>
            <button type="button"
                class="w-full md:w-auto bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-6 py-3 rounded-xl flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/10 cursor-pointer">
                <i class="fa-solid fa-check-double"></i>
                <span>تحديد الكل حاضر</span>
            </button>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-4">
            <div class="flex items-center justify-between border-b border-gray-100 dark:border-slate-800 pb-4">
                <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                    قائمة الطلاب (<span>4</span>)
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
                <div
                    class="flex flex-col sm:flex-row items-center justify-between border border-gray-100 dark:border-slate-800 p-4 rounded-2xl gap-4 bg-white dark:bg-slate-900 hover:border-gray-200 dark:hover:border-slate-700">
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 font-bold flex items-center justify-center shrink-0 shadow-inner">
                            ج
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-zinc-100">
                                جنى نضال الهلالي
                            </h4>
                            <p class="text-[10px] text-gray-400 font-mono mt-0.5">
                                STU-2024-018
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-check text-[10px]"></i> حاضر
                        </button>
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-clock text-[10px]"></i> متأخر
                        </button>
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-xmark text-[10px]"></i> غائب
                        </button>
                    </div>
                </div>

                <div
                    class="flex flex-col sm:flex-row items-center justify-between border border-gray-100 dark:border-slate-800 p-4 rounded-2xl gap-4 bg-white dark:bg-slate-900 hover:border-gray-200 dark:hover:border-slate-700">
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 font-bold flex items-center justify-center shrink-0 shadow-inner">
                            ح
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-zinc-100">
                                حمزة وليد الفار
                            </h4>
                            <p class="text-[10px] text-gray-400 font-mono mt-0.5">
                                STU-2024-019
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl text-[11px] font-bold bg-emerald-600 border border-emerald-600 text-white flex items-center gap-1 cursor-pointer shadow-sm">
                            <i class="fa-solid fa-check text-[10px]"></i> حاضر
                        </button>
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-clock text-[10px]"></i> متأخر
                        </button>
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-xmark text-[10px]"></i> غائب
                        </button>
                    </div>
                </div>

                <div
                    class="flex flex-col sm:flex-row items-center justify-between border border-gray-100 dark:border-slate-800 p-4 rounded-2xl gap-4 bg-white dark:bg-slate-900 hover:border-gray-200 dark:hover:border-slate-700">
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 font-bold flex items-center justify-center shrink-0 shadow-inner">
                            ر
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-800 dark:text-zinc-100">
                                رهف عدنان السكافي
                            </h4>
                            <p class="text-[10px] text-gray-400 font-mono mt-0.5">
                                STU-2024-020
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-check text-[10px]"></i> حاضر
                        </button>
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl text-[11px] font-bold bg-amber-500 border border-amber-500 text-white flex items-center gap-1 cursor-pointer shadow-sm">
                            <i class="fa-solid fa-clock text-[10px]"></i> متأخر
                        </button>
                        <button type="button"
                            class="px-4 py-1.5 rounded-xl border border-gray-200 dark:border-slate-800 text-[11px] font-bold text-gray-500 dark:text-slate-400 flex items-center gap-1 cursor-pointer">
                            <i class="fa-solid fa-xmark text-[10px]"></i> غائب
                        </button>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100 dark:border-slate-800 flex justify-end">
                <button type="submit"
                    class="bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg shadow-teal-600/10 cursor-pointer">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>حفظ الحضور</span>
                </button>
            </div>
        </div>
    </div>
@endsection
