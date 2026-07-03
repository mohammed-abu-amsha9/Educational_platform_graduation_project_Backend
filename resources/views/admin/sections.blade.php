@extends('admin.parent')
@section('title', 'الشعب')
@section('content')
    <div class="my-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                <div class="lg:col-span-4 order-1">
                    <div
                        class="bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 sticky top-8">
                        <div class="flex items-center gap-2 mb-6">
                            <div
                                class="w-8 h-8 bg-blue-50 dark:bg-blue-950/40 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <i class="fa-solid fa-plus text-sm"></i>
                            </div>
                            <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                                إنشاء شعبة جديد
                            </h2>
                        </div>

                        <form class="space-y-4" onsubmit="event.preventDefault()">
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                    الشعبة
                                </label>
                                <input type="text" placeholder="مثال:أ"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 -all text-gray-400 dark:text-zinc-400" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 dark:text-zinc-300 mb-1.5">الصف
                                    المرتبط</label>
                                <select
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none cursor-pointer focus:border-teal-500">
                                    <option value="">اختر الصف المرتبط هان...</option>
                                    <option value="1">الاول</option>
                                    <option value="2">الثاني</option>
                                    <option value="3">الثالث</option>
                                </select>
                            </div>

                            <button
                                class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-teal-700/20 -all flex items-center justify-center gap-2 mt-4">
                                <i class="fa-solid fa-save"></i>
                                <span>حفظ الشعبة</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div
                    class="lg:col-span-8 bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 order-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                            <span> الشعب</span>
                            <span
                                class="bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-400 text-xs px-2 py-1 rounded-full"
                                id="teacherCount">5</span>
                        </h2>
                    </div>

                    <div
                        class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md -all">
                        <button onclick="openModal('editRoleModal')"
                            class="absolute top-4 left-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-[11px] font-bold px-3 py-1.5 rounded-xl border border-gray-200/50 dark:border-slate-700 -all cursor-pointer flex items-center gap-1">
                            <i class="fa-solid fa-pen-to-square text-gray-400 dark:text-slate-400 text-[10px]"></i>
                            <span>تعديل</span>
                        </button>

                        <div class="flex items-start gap-4">
                            <div class="w-full">
                                <h3
                                    class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600 -colors text-sm">
                                    شعبة أ
                                </h3>

                                <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                    <span> المرتبطة بالصف الاول</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- مودال التعديل على الدور والصلاحيات -->
                    <div id="editRoleModal"
                        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm transition-opacity">
                        <div
                            class="bg-white dark:bg-slate-900 border border-emerald-400 rounded-3xl w-full max-w-lg shadow-2xl relative z-10 flex flex-col max-h-[90vh]">
                            <div
                                class="p-6 pb-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between shrink-0">
                                <h2 class="text-sm font-black text-teal-600 dark:text-teal-400 flex items-center gap-2">
                                    <i class="fa-solid fa-user-gear text-sm"></i> تعديل الدور
                                    والصلاحيات
                                </h2>
                                <button onclick="closeModal('editRoleModal')"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors cursor-pointer text-sm">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <form class="p-6 space-y-5 overflow-y-auto flex-1 max-h-[calc(100vh-16rem)]" id="editRoleForm"
                                onsubmit="event.preventDefault()">
                                <div>
                                    <label
                                        class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                        الشعبة
                                    </label>
                                    <input type="text" placeholder="مثال:أ"
                                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 -all text-gray-400 dark:text-zinc-400" />
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-700 dark:text-zinc-300 mb-1.5">الصف
                                        المرتبط</label>
                                    <select
                                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none cursor-pointer focus:border-teal-500">
                                        <option value="">اختر الصف المرتبط هان...</option>
                                        <option value="1">الاول</option>
                                        <option value="2">الثاني</option>
                                        <option value="3">الثالث</option>
                                    </select>
                                </div>
                            </form>

                            <form method="post" action=""
                                class="p-6 pt-4 border-t border-gray-100 dark:border-slate-800 flex justify-end gap-2 shrink-0">
                                <button type="button" onclick="closeModal('editRoleModal')"
                                    class="px-5 py-2.5 text-xs font-bold text-gray-500 dark:text-slate-400 bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 dark:hover:text-white rounded-xl transition-all cursor-pointer">
                                    إلغاء
                                </button>
                                <button type="submit"
                                    class="px-5 py-2.5 text-xs font-bold text-white dark:text-slate-950 bg-teal-600 hover:bg-teal-700 dark:bg-teal-400 dark:hover:bg-teal-500 rounded-xl transition-all shadow-md shadow-teal-500/10 cursor-pointer">
                                    حفظ التغييرات
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
