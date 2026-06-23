@extends('admin.parent')
@section('title', 'الطلاب')
@section('content')
    <div class="max-w-7xl mx-auto mt-6 space-y-6">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="w-full flex flex-col sm:flex-row items-center gap-3 justify-start">
                <div class="relative w-full sm:w-72">
                    <input id="searchInput" type="text" placeholder="ابحث باسم الطالب أو الرقم..."
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 pr-3 pl-10 text-right text-sm focus:outline-none focus:ring-2 focus:ring-teal-600" />
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"><i
                            class="fa-solid fa-magnifying-glass"></i></span>
                </div>

                <!-- فلتر الصفوف من الأول ابتدائي إلى التوجيهي -->
                <select id="classFilter"
                    class="w-full sm:w-48 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 text-sm rounded-xl py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-teal-600">
                    <option value="all">جميع الصفوف</option>

                    <!-- المرحلة الابتدائية -->
                    <option value="الصف الأول الابتدائي">الصف الأول الابتدائي</option>
                    <option value="الصف الثاني الابتدائي">
                        الصف الثاني الابتدائي
                    </option>
                    <option value="الصف الثالث الابتدائي">
                        الصف الثالث الابتدائي
                    </option>
                    <option value="الصف الرابع الابتدائي">
                        الصف الرابع الابتدائي
                    </option>
                    <option value="الصف الخامس الابتدائي">
                        الصف الخامس الابتدائي
                    </option>
                    <option value="الصف السادس الابتدائي">
                        الصف السادس الابتدائي
                    </option>

                    <!-- المرحلة الإعدادية / الأساسية العليا -->
                    <option value="الصف السابع">الصف السابع</option>
                    <option value="الصف الثامن">الصف الثامن</option>
                    <option value="الصف التاسع">الصف التاسع</option>
                    <option value="الصف العاشر">الصف العاشر</option>

                    <!-- المرحلة الثانوية -->
                    <option value="الصف الحادي عشر">الصف الحادي عشر</option>
                    <option value="توجيهي">توجيهي (الثاني عشر)</option>
                </select>
                <select id="financeFilter"
                    class="w-full sm:w-44 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 text-sm rounded-xl py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-teal-600">
                    <option value="all">جميع الحالات المادية</option>
                    <option value="مدفوع">مدفوع</option>
                    <option value="جزئي">جزئي</option>
                    <option value="غير مدفوع">غير مدفوع</option>
                </select>
            </div>
            <button onclick="openModal('addStudentModal')"
                class="w-full md:w-auto bg-teal-700 hover:bg-teal-800 text-white font-bold px-5 py-2.5 rounded-xl flex items-center justify-center gap-2 shrink-0 shadow-sm">
                <i class="fa-solid fa-plus text-sm"></i>
                <span>إضافة طالب</span>
            </button>
            <!-- modale add student -->
            <div id="addStudentModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-2 sm:p-4">
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('addStudentModal')">
                </div>

                <div
                    class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-2xl sm:rounded-3xl w-full max-w-lg shadow-2xl relative z-10 p-4 sm:p-6 animate-in fade-in zoom-in-95 duration-150 flex flex-col max-h-[92vh]">
                    <div
                        class="flex items-start justify-between border-b border-gray-100 dark:border-slate-800 pb-3 mb-4 shrink-0">
                        <h2 class="text-base sm:text-lg font-bold text-teal-700 dark:text-teal-400 flex items-center gap-2">
                            <i class="fa-solid fa-user-plus text-base"></i>
                            <span>إضافة طالب جديد للنظام</span>
                        </h2>
                        <button onclick="closeModal('addStudentModal')"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-300 text-xl w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50 -colors">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <form class="space-y-4 overflow-y-auto flex-1 pr-1 pl-1 text-right"
                        onsubmit="
                  event.preventDefault();
                  closeModal('addStudentModal');
                ">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">اسم
                                الطالب رباعي</label>
                            <input type="text" placeholder="أدخل اسم الطالب الكامل" required
                                class="w-full border text-slate-800 dark:text-zinc-100 border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">الصف
                                    الدراسي</label>
                                <select required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-slate-800 dark:text-zinc-100">
                                    <option value="">اختر الصف...</option>
                                    <option value="الصف الأول الابتدائي">
                                        الصف الأول الابتدائي
                                    </option>
                                    <option value="الصف الثاني الابتدائي">
                                        الصف الثاني الابتدائي
                                    </option>
                                    <option value="الصف الثالث الابتدائي">
                                        الصف الثالث الابتدائي
                                    </option>
                                    <option value="الصف الرابع الابتدائي">
                                        الصف الرابع الابتدائي
                                    </option>
                                    <option value="الصف الخامس الابتدائي">
                                        الصف الخامس الابتدائي
                                    </option>
                                    <option value="الصف السادس الابتدائي">
                                        الصف السادس الابتدائي
                                    </option>

                                    <option value="الصف السابع">الصف السابع</option>
                                    <option value="الصف الثامن">الصف الثامن</option>
                                    <option value="الصف التاسع">الصف التاسع</option>

                                    <option value="الصف العاشر">الصف العاشر</option>
                                    <option value="الصف الحادي عشر">الصف الحادي عشر</option>
                                    <option value="توجيهي">توجيهي (الثاني عشر)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">إجمالي
                                    الرسوم المطلوبة (₪)</label>
                                <input type="number" placeholder="مثال: 800" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-slate-800 dark:text-zinc-100" />
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-gray-50 dark:border-slate-800/60 pt-3">

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم
                                    هاتف ولي الأمر</label>
                                <input type="tel" placeholder="059XXXXXXXX" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم
                                    هاتف احتياطي</label>
                                <input type="tel" placeholder="059XXXXXXXX" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم
                                    هوية الطالب</label>
                                <input type="tel" placeholder="أدخل 9 أرقام" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم
                                    هوية ولي الأمر</label>
                                <input type="tel" placeholder="أدخل 9 أرقام" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-4 border-t border-gray-100 dark:border-slate-800 shrink-0">
                            <button type="button" onclick="closeModal('addStudentModal')"
                                class="px-4 py-2 text-xs font-bold text-gray-500 bg-gray-100 dark:bg-slate-800 rounded-xl hover:bg-gray-200 dark:hover:bg-slate-700">
                                إلغاء
                            </button>
                            <button type="submit"
                                class="px-5 py-2 text-xs font-bold text-white bg-teal-700 hover:bg-teal-800 rounded-xl shadow-md">
                                إضافة الطالب وتثبيته
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- الجدول -->
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/70 dark:bg-slate-800/40 border-b border-gray-100 dark:border-slate-800 text-xs font-bold text-gray-400 dark:text-zinc-400 tracking-wide">
                            <th class="p-4">الاسم</th>
                            <th class="p-4">رقم الطالب</th>
                            <th class="p-4">الصف</th>
                            <th class="p-4">الحضور</th>
                            <th class="p-4">الحالة المالية</th>
                            <th class="p-4">المتبقي</th>
                            <th class="p-4">الحساب</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60 text-sm">
                        <tr onclick="openModal('mainStudentModal')"
                            class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer -colors">
                            <td class="p-4 flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                    م
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        مريم أحمد يوسف
                                    </h4>
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                                        أحمد يوسف
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                STU-2024-001
                            </td>
                            <td class="p-4 text-gray-600 dark:text-zinc-300">
                                الصف الأول الثانوي
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-500">96%</span>
                                    <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-emerald-500 h-full rounded-full" style="width: 96%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-red-50 dark:bg-red-900/50 text-red-600 dark:text-red-400">غير
                                    مدفوع</span>
                            </td>
                            <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                ₪ 0
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">نشط</span>
                            </td>
                        </tr>

                        <tr onclick="openModal('mainStudentModal')"
                            class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer -colors">
                            <td class="p-4 flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                    ي
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        يوسف عمر البكري
                                    </h4>
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                                        عمر البكري
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                STU-2024-002
                            </td>
                            <td class="p-4 text-gray-600 dark:text-zinc-300">
                                الصف الأول الثانوي
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-500">88%</span>
                                    <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-amber-500 h-full rounded-full" style="width: 88%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400">جزئي</span>
                            </td>
                            <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                ₪ 300
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">نشط</span>
                            </td>
                        </tr>

                        <tr onclick="openModal('mainStudentModal')"
                            class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer -colors">
                            <td class="p-4 flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                    ل
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        ليلى حسن الناصر
                                    </h4>
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                                        حسن الناصر
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                STU-2024-003
                            </td>
                            <td class="p-4 text-gray-600 dark:text-zinc-300">
                                الصف الأول الثانوي
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-500">99%</span>
                                    <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-emerald-500 h-full rounded-full" style="width: 99%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400">مدفوع</span>
                            </td>
                            <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                ₪ 0
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">نشط</span>
                            </td>
                        </tr>

                        <tr onclick="openModal('mainStudentModal')"
                            class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer -colors">
                            <td class="p-4 flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                    م
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        محمد سامي العلي
                                    </h4>
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                                        سامي العلي
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                STU-2024-004
                            </td>
                            <td class="p-4 text-gray-600 dark:text-zinc-300">
                                الصف الأول الثانوي
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-500">75%</span>
                                    <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-amber-500 h-full rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400">جزئي</span>
                            </td>
                            <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                ₪ 500
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">نشط</span>
                            </td>
                        </tr>

                        <tr onclick="openModal('mainStudentModal')"
                            class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer -colors">
                            <td class="p-4 flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                    ف
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        فاطمة زياد طليمات
                                    </h4>
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                                        زياد طليمات
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                STU-2024-005
                            </td>
                            <td class="p-4 text-gray-600 dark:text-zinc-300">
                                الصف الأول الثانوي
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-500">91%</span>
                                    <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-emerald-500 h-full rounded-full" style="width: 91%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400">مدفوع</span>
                            </td>
                            <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                ₪ 0
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">نشط</span>
                            </td>
                        </tr>

                        <tr onclick="openModal('mainStudentModal')"
                            class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer -colors">
                            <td class="p-4 flex items-center gap-3">
                                <div
                                    class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                    أ
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                        أحمد عبد الرحمن السعدي
                                    </h4>
                                    <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">
                                        عبد الرحمن السعدي
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                STU-2024-006
                            </td>
                            <td class="p-4 text-gray-600 dark:text-zinc-300">
                                الصف الأول الثانوي
                            </td>
                            <td class="p-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-gray-500">82%</span>
                                    <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                        <div class="bg-amber-500 h-full rounded-full" style="width: 82%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400">جزئي</span>
                            </td>
                            <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                ₪ 200
                            </td>
                            <td class="p-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">نشط</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- modal student data -->
    <div id="mainStudentModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-2 sm:p-4">
        <!-- الخلفية المعتمة -->
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('mainStudentModal')">
        </div>

        <!-- صندوق المحتوى المطور: تم ضبط الارتفاع والتمرير الداخلي وعزل الهيدر والفوتر -->
        <div
            class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-2xl sm:rounded-3xl w-full max-w-3xl shadow-2xl relative z-10 p-4 sm:p-6 flex flex-col max-h-[92vh]">
            <!-- الهيدر: ثابت لا يختفي عند التمرير -->
            <div
                class="flex items-start justify-between border-b border-gray-100 dark:border-slate-800 pb-3 mb-4 shrink-0">
                <h2 class="text-base sm:text-lg font-bold text-teal-700 dark:text-teal-400">
                    ملف الطالب التفصيلي
                </h2>
                <button onclick="closeModal('mainStudentModal')"
                    class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-300 text-xl w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50 -colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- جسم المودال: قابل للتمرير الذكي (Scroll) على الشاشات الصغيرة -->
            <div class="overflow-y-auto flex-1 pr-1 pl-1 space-y-4 text-right">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 items-start">
                    <!-- بطاقة الطالب الجانبية -->
                    <div
                        class="md:col-span-1 border border-emerald-400 dark:border-slate-400 rounded-2xl p-4 flex flex-col items-center text-center bg-slate-50/30 dark:bg-slate-800/30">
                        <div
                            class="w-16 h-16 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl mb-3">
                            م
                        </div>
                        <h3 class="font-bold text-base text-slate-800 dark:text-zinc-100">
                            ملف الطالب المختار
                        </h3>
                        <p class="text-xs font-mono text-gray-400 mt-1">STU-2024-XXX</p>
                        <p
                            class="text-xs font-mono px-4 py-1 bg-blue-100 dark:bg-blue-950/50 rounded-2xl text-blue-900 dark:text-blue-300 mt-1">
                            الصف الأول الثانوي
                        </p>
                        <div class="mt-4">
                            <p class="text-xs text-gray-400 font-bold">
                                المعدل العام الحالي
                            </p>
                            <p class="text-3xl font-black text-teal-600 dark:text-teal-400 mt-1">
                                92%
                            </p>
                        </div>
                    </div>

                    <!-- البيانات وتفاصيل السجلات -->
                    <div class="md:col-span-2 space-y-4">
                        <!-- شبكة البيانات الأساسية المحدثة -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div
                                class="bg-gray-100/75 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">
                                    اسم ولي الأمر المسجل
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1">
                                    أحمد يوسف
                                </p>
                            </div>
                            <div
                                class="bg-gray-100/75 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">
                                    رقم التواصل الشخصي
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono">
                                    0599111001
                                </p>
                            </div>
                            <div
                                class="bg-gray-100/75 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">
                                    رقم هوية الطالب
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono">
                                    409273190
                                </p>
                            </div>
                            <div
                                class="bg-gray-100/75 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">
                                    رقم هوية ولي الامر
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono">
                                    409273190
                                </p>
                            </div>
                            <div
                                class="bg-gray-100/75 dark:bg-slate-800/30 border border-gray-100/70 dark:border-slate-800 p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">
                                    الرسوم
                                </p>
                                <p class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono">
                                    800₪ / 800₪
                                </p>
                            </div>
                        </div>

                        <!-- سجل درجات الطالب المحدث -->
                        <div class="border border-slate-200 dark:border-slate-800/80 rounded-xl p-3">
                            <h4 class="text-xs font-bold text-slate-700 dark:text-zinc-300 mb-2">
                                سجل درجات الطالب والاختبارات الأخيرة
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-xs">
                                <div
                                    class="flex justify-between items-center p-2 bg-gray-50 dark:bg-slate-800/40 rounded-lg">
                                    <span>اختبار الرياضيات - الفصل الأول</span>
                                    <span class="font-bold text-emerald-600">5/5</span>
                                </div>
                                <div
                                    class="flex justify-between items-center p-2 bg-gray-50 dark:bg-slate-800/40 rounded-lg">
                                    <span>اختبار اللغة الإنجليزية - القواعد</span>
                                    <span class="font-bold text-emerald-600">4/4</span>
                                </div>
                            </div>
                        </div>

                        <!-- سجل المدفوعات والفواتير المحدث -->
                        <div class="border border-slate-200 dark:border-slate-800/80 rounded-xl p-3">
                            <h4 class="text-xs font-bold text-slate-700 dark:text-zinc-300 mb-2">
                                سجل المدفوعات والفواتير
                            </h4>
                            <div class="grid grid-cols-1 gap-2 text-xs">
                                <div
                                    class="flex justify-between items-center p-2 bg-gray-50 dark:bg-slate-800/40 rounded-lg">
                                    <span>2024-09-15 - نقداً</span>
                                    <span class="font-bold text-slate-500 dark:text-zinc-400"><i
                                            class="fa-solid fa-circle-check text-emerald-500 ml-1"></i>
                                        تم السداد</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- الفوتر: أزرار التحكم الثابتة المتجاوبة بالكامل في الموبايل -->
            <div
                class="flex flex-wrap items-center justify-center gap-1.5 sm:gap-2 mt-4 pt-3 border-t border-slate-200 dark:border-slate-800 shrink-0">
                <button onclick="closeModal('mainStudentModal')"
                    class="px-3 py-2 text-xs font-bold text-gray-500 bg-gray-100 dark:bg-slate-800 rounded-xl hover:bg-gray-200 dark:hover:bg-slate-700">
                    إغلاق
                </button>
                <button onclick="switchModal('mainStudentModal', 'editDataModal')"
                    class="px-3 py-2 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-xl flex items-center gap-1">
                    <i class="fa-solid fa-marker"></i> تعديل البيانات
                </button>
                <button onclick="switchModal('mainStudentModal', 'editClassModal')"
                    class="px-3 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl flex items-center gap-1">
                    <i class="fa-solid fa-chalkboard-user"></i> الصف
                </button>
                <button onclick="switchModal('mainStudentModal', 'editFeesModal')"
                    class="px-3 py-2 text-xs font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-xl flex items-center gap-1">
                    <i class="fa-solid fa-hand-holding-dollar"></i> الرسوم
                </button>
            </div>
        </div>
    </div>

    <div id="editDataModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('editDataModal')">
        </div>
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative z-10 p-6 border border-emerald-400 dark:border-slate-400">
            <h3 class="text-base font-bold text-amber-600 mb-4">
                <i class="fa-solid fa-marker"></i> تعديل البيانات الأساسية
            </h3>
            <form class="space-y-4"
                onsubmit="
              event.preventDefault();
              closeModal('editDataModal');
            ">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">اسم الطالب
                        رباعي</label>
                    <input type="text" value="مريم أحمد يوسف"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هوية
                        الطالب</label>
                    <input type="number" value=""
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هوية ولي
                        الامر</label>
                    <input type="number" value=""
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم الهاتف
                        الشخصي</label>
                    <input type="number" value=""
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="switchModal('editDataModal', 'mainStudentModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 dark:bg-slate-800 rounded-xl">
                        رجوع
                    </button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-amber-500 rounded-xl">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editClassModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('editClassModal')">
        </div>
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative z-10 p-6 border border-emerald-400 dark:border-slate-400">
            <h3 class="text-base font-bold text-blue-600 mb-4">
                📚 نقل وتعديل الصف
            </h3>
            <form class="space-y-4"
                onsubmit="
              event.preventDefault();
              closeModal('editClassModal');
            ">
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">اختر الصف الدراسي
                        الجديد</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none">
                        <option>الصف الأول الثانوي</option>
                        <option>الصف الثاني الثانوي</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="switchModal('editClassModal', 'mainStudentModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 dark:bg-slate-800 rounded-xl">
                        رجوع
                    </button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-blue-600 rounded-xl">
                        تحديث
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editFeesModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('editFeesModal')">
        </div>
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative z-10 p-6 border border-emerald-400 dark:border-slate-400">
            <h3 class="text-base font-bold text-teal-600 mb-4">
                💰 إدارة وتعديل الرسوم المدرسية
            </h3>
            <form class="space-y-4"
                onsubmit="
              event.preventDefault();
              closeModal('editFeesModal');
            ">
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">إجمالي
                            الرسوم</label>
                        <input type="number" value="800"
                            class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">المدفوع</label>
                        <input type="number" value="800"
                            class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="switchModal('editFeesModal', 'mainStudentModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 dark:bg-slate-800 rounded-xl">
                        رجوع
                    </button>
                    <button type="submit" class="px-4 py-2 text-xs font-bold text-white bg-teal-600 rounded-xl">
                        حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
                document.body.style.overflow = "hidden";
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
                document.body.style.overflow = "auto";
            }
        }

        function switchModal(currentModalId, targetModalId) {
            closeModal(currentModalId);
            setTimeout(() => {
                openModal(targetModalId);
            }, 150);
        }
        // تفعيل الفرز والبحث الديناميكي
        document.addEventListener("DOMContentLoaded", () => {
            const searchInput = document.getElementById("searchInput");
            const financeFilter = document.getElementById("financeFilter");
            const classFilter = document.getElementById("classFilter");

            // دالة الفحص والفلترة
            function filterStudents() {
                const searchValue = searchInput.value.trim().toLowerCase();
                const financeValue = financeFilter.value;
                const classValue = classFilter.value;

                // جلب جميع أسطر الطلاب داخل الجدول (تأكد أن الأسطر داخل tbody)
                const rows = document.querySelectorAll("tbody tr");

                rows.forEach((row) => {
                    // جلب النصوص من الحقول الداخلية لكل طالب داخل السطر
                    const studentName = row.cells[0]
                        .querySelector("h4")
                        .innerText.toLowerCase();
                    const studentId = row.cells[1].innerText.toLowerCase();
                    const studentClass = row.cells[2].innerText.trim();
                    const financeStatus = row.cells[4]
                        .querySelector("span")
                        .innerText.trim();

                    // شروط المطابقة
                    const matchesSearch =
                        studentName.includes(searchValue) ||
                        studentId.includes(searchValue);
                    const matchesFinance =
                        financeValue === "all" || financeStatus === financeValue;
                    const matchesClass =
                        classValue === "all" || studentClass === classValue;

                    // إذا تحققت كل الشروط اظهر السطر، وإلا قم بإخفائه
                    if (matchesSearch && matchesFinance && matchesClass) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            // ربط الأحداث بمجرد الكتابة أو تغيير الفلاتر ليعمل الفرز فوراً بدون تحديث الصفحة
            searchInput.addEventListener("input", filterStudents);
            financeFilter.addEventListener("change", filterStudents);
            classFilter.addEventListener("change", filterStudents);
        });
    </script>
@endsection
