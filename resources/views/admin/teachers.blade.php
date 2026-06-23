@extends('admin.parent')
@section('title', 'المعلمون')
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
                                تسجيل معلم جديد
                            </h2>
                        </div>

                        <form class="space-y-4" onsubmit="event.preventDefault()">
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                    المعلم</label>
                                <input type="text" placeholder="الاسم الكامل"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 text-gray-400 dark:text-zinc-400" />
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">رقم
                                    الموظف</label>
                                <input type="text" placeholder="ID-000"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 font-mono text-gray-400 dark:text-zinc-400" />
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">رقم
                                    الهاتف</label>
                                <input type="text" placeholder="0599999999"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 font-mono text-gray-400 dark:text-zinc-400" />
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">المادة</label>
                                <select
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 cursor-pointer">
                                    <option>الرياضيات</option>
                                    <option>اللغة العربية</option>
                                    <option>العلوم</option>
                                    <option>اللغة الانجليزية</option>
                                    <option>الكيمياء</option>
                                    <option>الاحياء</option>
                                    <option>التربيةالاسلامية</option>
                                </select>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">الصفوف
                                    المسندة</label>
                                <div
                                    class="border border-gray-100 dark:border-slate-800 rounded-xl p-3 max-h-32 overflow-y-auto space-y-2 text-xs custom-scroll bg-slate-50/50 dark:bg-slate-800/30">
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الأول
                                            الابتدائي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الثاني
                                            الابتدائي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الثالث
                                            الابتدائي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الرابع
                                            الابتدائي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الخامس
                                            الإعدادي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف السادس
                                            الإعدادي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف السابع
                                            الإعدادي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الثامن
                                            الإعدادي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف التاسع
                                            الإعدادي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف العاشر
                                            الإعدادي</span><input type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف الحادي عشر </span><input
                                            type="checkbox" class="accent-teal-600" /></label>
                                    <label class="flex items-center justify-between"><span
                                            class="text-gray-600 dark:text-zinc-300">الصف التوجيهي</span><input
                                            type="checkbox" class="accent-teal-600" /></label>
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">
                                    الدور الوظيفي (الصلاحيات)
                                </label>
                                <div class="relative">
                                    <select name="role_id"
                                        class="w-full border border-gray-100 dark:border-slate-800 rounded-xl p-3 text-xs bg-slate-50/50 dark:bg-slate-800/30 text-gray-600 dark:text-zinc-300 focus:outline-none focus:border-blue-500 appearance-none cursor-pointer">
                                        <option value="" disabled selected>
                                            اختر الدور المرتبط بالمعلم...
                                        </option>
                                        <option value="1">معلم لغة عربية</option>
                                        <option value="2">معلم رياضيات</option>
                                        <option value="3">معلم لغة إنجليزية</option>
                                        <option value="4">مساعد إداري</option>
                                    </select>
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 text-gray-400">
                                    </div>
                                </div>
                            </div>

                            <button
                                class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-teal-700/20 flex items-center justify-center gap-2 mt-4">
                                <i class="fa-solid fa-save"></i>
                                <span>حفظ المعلم</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div
                    class="lg:col-span-8 bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 order-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                            <span>قائمة المعلمين</span>
                            <span
                                class="bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-400 text-xs px-2 py-1 rounded-full"
                                id="teacherCount">5</span>
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="teacherList">
                        <div onclick="
                    openViewModal(
                      'خالد النجار',
                      'T-1001',
                      'الرياضيات',
                      '3 صفوف',
                      '5 صلاحيات',
                    )
                  "
                            class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer">
                            <span
                                class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl shadow-inner">
                                    خ
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600 -colors">
                                        خالد النجار
                                    </h3>
                                    <p class="text-xs text-gray-400 font-mono">T-1001</p>
                                    <div
                                        class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                        <span><i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                            الرياضيات</span>
                                        <span><i class="fa-solid fa-school ml-1 text-blue-500"></i>
                                            3 صفوف</span>
                                        <span><i class="fa-solid fa-key ml-1 text-amber-500"></i> 5
                                            صلاحيات</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div onclick="
                    openViewModal(
                      'سارة الدهان',
                      'T-1002',
                      'اللغة العربية',
                      '4 صفوف',
                      '3 صلاحيات',
                    )
                  "
                            class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer">
                            <span
                                class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-950/40 flex items-center justify-center text-blue-600 dark:text-blue-400 font-black text-xl">
                                    س
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-zinc-100">
                                        سارة الدهان
                                    </h3>
                                    <p class="text-xs text-gray-400 font-mono">T-1002</p>
                                    <div
                                        class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                        <span><i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                            اللغة العربية</span>
                                        <span><i class="fa-solid fa-school ml-1 text-blue-500"></i>
                                            4 صفوف</span>
                                        <span><i class="fa-solid fa-key ml-1 text-amber-500"></i> 3
                                            صلاحيات</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div onclick="
                    openViewModal(
                      'خالد النجار',
                      'T-1001',
                      'الرياضيات',
                      '3 صفوف',
                      '5 صلاحيات',
                    )
                  "
                            class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer">
                            <span
                                class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl shadow-inner">
                                    خ
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600 -colors">
                                        خالد النجار
                                    </h3>
                                    <p class="text-xs text-gray-400 font-mono">T-1001</p>
                                    <div
                                        class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                        <span><i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                            الرياضيات</span>
                                        <span><i class="fa-solid fa-school ml-1 text-blue-500"></i>
                                            3 صفوف</span>
                                        <span><i class="fa-solid fa-key ml-1 text-amber-500"></i> 5
                                            صلاحيات</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div onclick="
                    openViewModal(
                      'سارة الدهان',
                      'T-1002',
                      'اللغة العربية',
                      '4 صفوف',
                      '3 صلاحيات',
                    )
                  "
                            class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer">
                            <span
                                class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-950/40 flex items-center justify-center text-blue-600 dark:text-blue-400 font-black text-xl">
                                    س
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-zinc-100">
                                        سارة الدهان
                                    </h3>
                                    <p class="text-xs text-gray-400 font-mono">T-1002</p>
                                    <div
                                        class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                        <span><i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                            اللغة العربية</span>
                                        <span><i class="fa-solid fa-school ml-1 text-blue-500"></i>
                                            4 صفوف</span>
                                        <span><i class="fa-solid fa-key ml-1 text-amber-500"></i> 3
                                            صلاحيات</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div onclick="
                    openViewModal(
                      'خالد النجار',
                      'T-1001',
                      'الرياضيات',
                      '3 صفوف',
                      '5 صلاحيات',
                    )
                  "
                            class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer">
                            <span
                                class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl shadow-inner">
                                    خ
                                </div>
                                <div>
                                    <h3
                                        class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600 -colors">
                                        خالد النجار
                                    </h3>
                                    <p class="text-xs text-gray-400 font-mono">T-1001</p>
                                    <div
                                        class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                        <span><i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                            الرياضيات</span>
                                        <span><i class="fa-solid fa-school ml-1 text-blue-500"></i>
                                            3 صفوف</span>
                                        <span><i class="fa-solid fa-key ml-1 text-amber-500"></i> 5
                                            صلاحيات</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div onclick="
                    openViewModal(
                      'سارة الدهان',
                      'T-1002',
                      'اللغة العربية',
                      '4 صفوف',
                      '3 صلاحيات',
                    )
                  "
                            class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer">
                            <span
                                class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-950/40 flex items-center justify-center text-blue-600 dark:text-blue-400 font-black text-xl">
                                    س
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-zinc-100">
                                        سارة الدهان
                                    </h3>
                                    <p class="text-xs text-gray-400 font-mono">T-1002</p>
                                    <div
                                        class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                        <span><i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                            اللغة العربية</span>
                                        <span><i class="fa-solid fa-school ml-1 text-blue-500"></i>
                                            4 صفوف</span>
                                        <span><i class="fa-solid fa-key ml-1 text-amber-500"></i> 3
                                            صلاحيات</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="viewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm -opacity" onclick="closeModal('viewModal')">
        </div>
        <div class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl relative z-10 p-6 transform scale-95 opacity-0 duration-300"
            id="viewContent">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-lg font-black text-teal-700">ملف المعلم</h2>
                <button onclick="closeModal('viewModal')" class="text-gray-400 hover:text-rose-500 -colors">
                    <i class="fa-solid fa-circle-xmark text-xl"></i>
                </button>
            </div>

            <div class="flex flex-col items-center text-center mb-6">
                <div id="vAvatar"
                    class="w-20 h-20 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 font-black text-3xl mb-3 shadow-inner">
                    خ
                </div>
                <h3 id="vName" class="text-xl font-black text-slate-800 dark:text-zinc-100">
                    خالد النجار
                </h3>
                <span id="vId"
                    class="text-xs font-mono text-gray-400 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded mt-1">T-1001</span>
            </div>

            <div class="grid grid-cols-1 gap-3 mb-8">
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">المادة المدرّسة</span>
                    <span id="vSubject" class="text-sm font-bold text-slate-700 dark:text-zinc-200">الرياضيات</span>
                </div>
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">الصفوف</span>
                    <span id="vClasses" class="text-sm font-bold text-slate-700 dark:text-zinc-200">3 صفوف</span>
                </div>
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">الصلاحيات</span>
                    <span id="vPerms" class="text-sm font-bold text-slate-700 dark:text-zinc-200">5
                        صلاحيات</span>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="switchModal('viewModal', 'editModal')"
                    class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-2xl flex items-center justify-center gap-2">
                    <i class="fa-solid fa-pen-to-square"></i> تعديل
                </button>
                <button onclick="switchModal('viewModal', 'deleteModal')"
                    class="flex-1 bg-rose-500 hover:bg-rose-600 text-white font-bold py-3 rounded-2xl flex items-center justify-center gap-2">
                    <i class="fa-solid fa-trash-can"></i> حذف
                </button>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('editModal')"></div>

        <div
            class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl relative z-10 p-6 max-h-[90vh] flex flex-col">
            <h2 class="text-lg font-black text-amber-600 mb-4 flex items-center gap-2 shrink-0">
                <i class="fa-solid fa-pen-to-square"></i> تعديل بيانات المعلم
            </h2>

            <form class="space-y-4 overflow-y-auto pr-1 flex-1 custom-scroll max-h-[calc(100vh-16rem)]"
                id="editNameInput">
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">اسم المعلم</label>
                    <input type="text" value="خالد النجار"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none dark:text-zinc-100" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">رقم الموظف</label>
                    <input type="text" value="T-1001"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none dark:text-zinc-100" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">رقم الهاتف</label>
                    <input type="number" value="05999999999"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none dark:text-zinc-100" />
                </div>
                <div>
                    <label class="block text-[11px] font-black text-slate-500 mb-1.5 uppercase">الصفوف
                        المسندة</label>
                    <div
                        class="border border-gray-100 dark:border-slate-800 rounded-xl p-3 max-h-32 overflow-y-auto space-y-2 text-xs custom-scroll bg-slate-50/50 dark:bg-slate-800/30">
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الأول الابتدائي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الثاني الابتدائي</span><input
                                type="checkbox" class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الثالث الابتدائي</span><input
                                type="checkbox" class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الرابع الابتدائي</span><input
                                type="checkbox" class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الخامس الإعدادي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف السادس الإعدادي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف السابع الإعدادي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الثامن الإعدادي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف التاسع الإعدادي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف العاشر الإعدادي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف الحادي عشر </span><input type="checkbox"
                                class="accent-teal-600" /></label>
                        <label class="flex items-center justify-between"><span
                                class="text-gray-600 dark:text-zinc-300">الصف التوجيهي</span><input type="checkbox"
                                class="accent-teal-600" /></label>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">
                        الدور الوظيفي (الصلاحيات)
                    </label>
                    <div class="relative">
                        <select name="role_id"
                            class="w-full border border-gray-100 dark:border-slate-800 rounded-xl p-3 text-xs bg-slate-50/50 dark:bg-slate-800/30 text-gray-600 dark:text-zinc-300 focus:outline-none focus:border-blue-500 appearance-none cursor-pointer">
                            <option value="" disabled selected>
                                اختر الدور المرتبط بالمعلم...
                            </option>
                            <option value="1">معلم لغة عربية</option>
                            <option value="2">معلم رياضيات</option>
                            <option value="3">معلم لغة إنجليزية</option>
                            <option value="4">مساعد إداري</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center px-3 text-gray-400">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-slate-800 shrink-0">
                    <button type="button" onclick="switchModal('editModal', 'viewModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 dark:bg-slate-800 rounded-xl cursor-pointer">
                        رجوع
                    </button>
                    <button onclick="closeModal('editModal')" type="submit"
                        class="px-4 py-2 text-xs font-bold text-white bg-amber-500 rounded-xl cursor-pointer">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('deleteModal')"></div>
        <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-xs shadow-2xl relative z-10 p-6 text-center">
            <div
                class="w-16 h-16 bg-rose-50 dark:bg-rose-950 text-rose-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-lg font-black text-slate-800 dark:text-zinc-100 mb-2">
                حذف المعلم؟
            </h3>
            <p class="text-xs text-gray-400 mb-6 leading-relaxed">
                أنت على وشك حذف بيانات هذا المعلم نهائياً من النظام، هل تريد
                الاستمرار؟
            </p>
            <div class="flex gap-2">
                <button onclick="closeModal('deleteModal')"
                    class="flex-1 py-3 text-sm font-bold text-gray-500 bg-slate-100 dark:bg-slate-800 rounded-xl">
                    تراجع
                </button>
                <button
                    onclick="
                alert('تم الحذف');
                closeModal('deleteModal');
              "
                    class="flex-1 py-3 text-sm font-bold text-white bg-rose-500 rounded-xl">
                    نعم، احذف
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        // دالة فتح المودال وتعبئته بالبيانات
        function openViewModal(name, id, subject, classes, perms) {
            document.getElementById("vName").innerText = name;
            document.getElementById("vId").innerText = id;
            document.getElementById("vSubject").innerText = subject;
            document.getElementById("vClasses").innerText = classes;
            document.getElementById("vPerms").innerText = perms;
            document.getElementById("vAvatar").innerText = name.charAt(0);
            document.getElementById("editNameInput").value = name;

            const modal = document.getElementById("viewModal");
            const content = document.getElementById("viewContent");

            modal.classList.remove("hidden");
            setTimeout(() => {
                content.classList.remove("scale-95", "opacity-0");
            }, 10);
        }

        // دالة إغلاق المودال مع تأثير أنيميشن
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modalId === "viewModal") {
                document
                    .getElementById("viewContent")
                    .classList.add("scale-95", "opacity-0");
                setTimeout(() => modal.classList.add("hidden"), 300);
            } else {
                modal.classList.add("hidden");
            }
        }

        // دالة التنقل بين المودالات (مثلاً من العرض للتعديل)
        function switchModal(currentId, nextId) {
            document.getElementById(currentId).classList.add("hidden");
            document.getElementById(nextId).classList.remove("hidden");
        }
    </script>
@endsection
