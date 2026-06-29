@extends('admin.parent')
@section('title', 'الطلاب')
@section('content')
    <div class="max-w-7xl mx-auto mt-6 space-y-6">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">

            <form id="filterForm" method="GET" action="{{ route('students.index') }}"
                class="w-full flex flex-col sm:flex-row items-center gap-3 justify-start">

                <div class="relative w-full sm:w-72">
                    <input id="searchInput" type="search" name="search" value="{{ request('search') }}" autocomplete="off"
                        placeholder="ابحث باسم الطالب أو الرقم..."
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 pr-3 pl-10 text-right text-sm focus:outline-none focus:ring-2 focus:ring-teal-600" />
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                </div>

                <select name="academic_level" id="classFilter" onchange="document.getElementById('filterForm').submit()"
                    class="w-full sm:w-48 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 text-sm rounded-xl py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-100 cursor-pointer">
                    <option value="all"
                        {{ request('academic_level') == 'all' || !request('academic_level') ? 'selected' : '' }}>جميع الصفوف
                    </option>

                    <optgroup label="المرحلة الابتدائية" class="text-xs text-gray-400 bg-gray-50 dark:bg-slate-900">
                        <option value="الصف الأول الابتدائي"
                            {{ request('academic_level') == 'الصف الأول الابتدائي' ? 'selected' : '' }}>الصف الأول الابتدائي
                        </option>
                        <option value="الصف الثاني الابتدائي"
                            {{ request('academic_level') == 'الصف الثاني الابتدائي' ? 'selected' : '' }}>الصف الثاني
                            الابتدائي</option>
                        <option value="الصف الثالث الابتدائي"
                            {{ request('academic_level') == 'الصف الثالث الابتدائي' ? 'selected' : '' }}>الصف الثالث
                            الابتدائي</option>
                        <option value="الصف الرابع الابتدائي"
                            {{ request('academic_level') == 'الصف الرابع الابتدائي' ? 'selected' : '' }}>الصف الرابع
                            الابتدائي</option>
                        <option value="الصف الخامس الابتدائي"
                            {{ request('academic_level') == 'الصف الخامس الابتدائي' ? 'selected' : '' }}>الصف الخامس
                            الابتدائي</option>
                        <option value="الصف السادس الابتدائي"
                            {{ request('academic_level') == 'الصف السادس الابتدائي' ? 'selected' : '' }}>الصف السادس
                            الابتدائي</option>
                    </optgroup>

                    <optgroup label="المرحلة الإعدادية" class="text-xs text-gray-400 bg-gray-50 dark:bg-slate-900">
                        <option value="الصف السابع" {{ request('academic_level') == 'الصف السابع' ? 'selected' : '' }}>الصف
                            السابع</option>
                        <option value="الصف الثامن" {{ request('academic_level') == 'الصف الثامن' ? 'selected' : '' }}>الصف
                            الثامن</option>
                        <option value="الصف التاسع" {{ request('academic_level') == 'الصف التاسع' ? 'selected' : '' }}>الصف
                            التاسع</option>
                        <option value="الصف العاشر" {{ request('academic_level') == 'الصف العاشر' ? 'selected' : '' }}>الصف
                            العاشر</option>
                    </optgroup>

                    <optgroup label="المرحلة الثانوية" class="text-xs text-gray-400 bg-gray-50 dark:bg-slate-900">
                        <option value="الصف الحادي عشر"
                            {{ request('academic_level') == 'الصف الحادي عشر' ? 'selected' : '' }}>الصف الحادي عشر</option>
                        <option value="توجيهي" {{ request('academic_level') == 'توجيهي' ? 'selected' : '' }}>توجيهي (الثاني
                            عشر)</option>
                    </optgroup>
                </select>

                <select name="financial_status" id="financeFilter" onchange="document.getElementById('filterForm').submit()"
                    class="w-full sm:w-44 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 text-sm rounded-xl py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-100 cursor-pointer">
                    <option value="all"
                        {{ request('financial_status') == 'all' || !request('financial_status') ? 'selected' : '' }}>جميع
                        الحالات المادية</option>
                    <option value="paid" {{ request('financial_status') == 'paid' ? 'selected' : '' }}>مدفوع</option>
                    <option value="partial" {{ request('financial_status') == 'partial' ? 'selected' : '' }}>جزئي</option>
                    <option value="unpaid" {{ request('financial_status') == 'unpaid' ? 'selected' : '' }}>غير مدفوع
                    </option>
                </select>
            </form>

            <button onclick="openModal('addStudentModal')"
                class="w-full md:w-auto bg-teal-700 hover:bg-teal-800 text-white font-bold px-5 py-2.5 rounded-xl flex items-center justify-center gap-2 shrink-0 shadow-sm transition-colors">
                <i class="fa-solid fa-plus text-sm"></i>
                <span>إضافة طالب</span>
            </button>
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
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-300 text-xl w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('students.store') }}"
                        class="space-y-4 overflow-y-auto flex-1 pr-1 pl-1 text-right">
                        @csrf

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">اسم الطالب
                                رباعي</label>
                            <input type="text" placeholder="أدخل اسم الطالب الكامل" name="full_name" required
                                class="w-full border text-slate-800 dark:text-zinc-100 border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none" />
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">الصف
                                    الدراسي</label>
                                <select name="academic_level" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-slate-800 dark:text-zinc-100">
                                    <option value="">اختر الصف...</option>
                                    <option value="الصف الأول الابتدائي">الصف الأول الابتدائي</option>
                                    <option value="الصف الثاني الابتدائي">الصف الثاني الابتدائي</option>
                                    <option value="الصف الثالث الابتدائي">الصف الثالث الابتدائي</option>
                                    <option value="الصف الرابع الابتدائي">الصف الرابع الابتدائي</option>
                                    <option value="الصف الخامس الابتدائي">الصف الخامس الابتدائي</option>
                                    <option value="الصف السادس الابتدائي">الصف السادس الابتدائي</option>
                                    <option value="الصف السابع">الصف السابع</option>
                                    <option value="الصف الثامن">الصف الثامن</option>
                                    <option value="الصف التاسع">الصف التاسع</option>
                                    <option value="الصف العاشر">الصف العاشر</option>
                                    <option value="الصف الحادي عشر">الصف الحادي عشر</option>
                                    <option value="توجيهي">توجيهي (الثاني عشر)</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">الشعبة</label>
                                <select required name="section_name"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-slate-800 dark:text-zinc-100">
                                    <option value="">اختر الشعبة...</option>
                                    <option value="شعبة (أ)">شعبة (أ)</option>
                                    <option value="شعبة (ب)">شعبة (ب)</option>
                                    <option value="شعبة (ج)">شعبة (ج)</option>
                                    <option value="بدون شعبة">بدون شعبة / عام</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">إجمالي الرسوم
                                    المطلوبة</label>
                                <input type="number" name="total_paid_amount" placeholder="مثال: 800" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-slate-800 dark:text-zinc-100" />
                            </div>
                        </div>

                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 gap-4 border-t border-gray-50 dark:border-slate-800/60 pt-3">
                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هاتف ولي
                                    الأمر</label>
                                <input type="tel" placeholder="059XXXXXXXX" name="parent_phone" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هاتف
                                    احتياطي</label>
                                <input type="tel" placeholder="059XXXXXXXX" name="parent_backup_phone"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هوية
                                    الطالب</label>
                                <input type="tel" placeholder="أدخل 9 أرقام" name="id" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هوية ولي
                                    الأمر</label>
                                <input type="tel" placeholder="أدخل 9 أرقام" required name="parent_id"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm focus:ring-2 focus:ring-teal-600 outline-none text-left font-mono text-slate-800 dark:text-zinc-100"
                                    dir="ltr" />
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 pt-4 border-t border-gray-100 dark:border-slate-800 shrink-0">
                            <button type="button" onclick="closeModal('addStudentModal')"
                                class="px-4 py-2 text-xs font-bold text-gray-500 bg-gray-100 dark:bg-slate-800 rounded-xl hover:bg-gray-200 dark:hover:bg-slate-700 transition-colors">
                                إلغاء
                            </button>
                            <button type="submit"
                                class="px-5 py-2 text-xs font-bold text-white bg-teal-700 hover:bg-teal-800 rounded-xl shadow-md transition-colors">
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
                        @forelse ($data as $student)
                            <tr onclick="openStudentModal({{ json_encode($student) }})"
                                class="hover:bg-slate-50/50 dark:hover:bg-slate-800/20 cursor-pointer transition-colors">

                                <td class="p-4 flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-bold">
                                        {{ mb_substr($student->full_name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 dark:text-zinc-200">{{ $student->full_name }}
                                        </h4>
                                        <p class="text-xs text-gray-400 dark:text-zinc-500 mt-0.5">هوية الطالب:
                                            {{ $student->id }}</p>
                                    </div>
                                </td>

                                <td class="p-4 font-mono text-xs text-gray-500 dark:text-zinc-400">
                                    {{ $student->student_code }}
                                </td>

                                <td class="p-4 text-gray-600 dark:text-zinc-300">
                                    {{ $student->academic_level }} - {{ $student->section_name }}
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="text-xs font-bold text-gray-500">{{ $student->attendance_percentage }}%</span>
                                        <div class="w-16 bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                                            <div class="bg-emerald-500 h-full rounded-full"
                                                style="width: {{ $student->attendance_percentage }}%"></div>
                                        </div>
                                    </div>
                                </td>

                                <td class="p-4">
                                    @if ($student->financial_status == 'paid')
                                        <span
                                            class="px-2.5 py-1 text-xs font-bold rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400">مدفوع
                                            بالكامل</span>
                                    @elseif($student->financial_status == 'partial')
                                        <span
                                            class="px-2.5 py-1 text-xs font-bold rounded-lg bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400">مدفوع
                                            جزئي</span>
                                    @elseif($student->financial_status == 'unpaid')
                                        <span
                                            class="px-2.5 py-1 text-xs font-bold rounded-lg bg-red-50 dark:bg-red-900/50 text-red-600 dark:text-red-400">غير
                                            مدفوع</span>
                                    @endif
                                </td>

                                <td class="p-4 font-bold text-slate-700 dark:text-zinc-300">
                                    ₪ {{ $student->remaining_fees }}
                                </td>

                                <td class="p-4">
                                    <span
                                        class="px-2.5 py-1 text-xs font-bold rounded-lg bg-teal-50 dark:bg-teal-950/40 text-teal-600 dark:text-teal-400">
                                        {{ $student->account_status == 'active' ? 'نشط' : 'موقف' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-16 text-gray-400 text-sm">
                                    <i class="fa-solid fa-users-slash text-3xl mb-3 block"></i>
                                    لا يوجد طلاب مسجلون بعد
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <div id="mainStudentModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-2 sm:p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('mainStudentModal')"></div>
        <div
            class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-2xl sm:rounded-3xl w-full max-w-3xl shadow-2xl relative z-10 p-4 sm:p-6 flex flex-col max-h-[92vh]">
            <div
                class="flex items-start justify-between border-b border-gray-100 dark:border-slate-800 pb-3 mb-4 shrink-0">
                <h2 class="text-base sm:text-lg font-bold text-teal-700 dark:text-teal-400">ملف الطالب التفصيلي</h2>
                <button onclick="closeModal('mainStudentModal')"
                    class="text-gray-400 hover:text-gray-600 text-xl w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-50"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>

            <div class="overflow-y-auto flex-1 space-y-4 text-right">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 items-start">
                    <div
                        class="md:col-span-1 border border-emerald-400 dark:border-slate-400 rounded-2xl p-4 flex flex-col items-center text-center bg-slate-50/30 dark:bg-slate-800/30">
                        <div id="modal_avatar"
                            class="w-16 h-16 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl mb-3">
                        </div>
                        <h3 id="modal_full_name" class="font-bold text-base text-slate-800 dark:text-zinc-100"></h3>
                        <p id="modal_student_code" class="text-xs font-mono text-gray-400 mt-1"></p>
                        <p id="modal_academic_badge"
                            class="text-xs font-mono px-4 py-1 bg-blue-100 dark:bg-blue-950/50 rounded-2xl text-blue-900 dark:text-blue-300 mt-1">
                        </p>
                    </div>

                    <div class="md:col-span-2 space-y-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="bg-gray-100/75 dark:bg-slate-800/30 border p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">اسم ولي الأمر المسجل</p>
                                <p id="modal_parent_name"
                                    class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1"></p>
                            </div>
                            <div class="bg-gray-100/75 dark:bg-slate-800/30 border p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">رقم التواصل الشخصي</p>
                                <p id="modal_parent_phone"
                                    class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono"></p>
                            </div>
                            <div class="bg-gray-100/75 dark:bg-slate-800/30 border p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">رقم هوية الطالب</p>
                                <p id="modal_student_id"
                                    class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono"></p>
                            </div>
                            <div class="bg-gray-100/75 dark:bg-slate-800/30 border p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">رقم هوية ولي الامر</p>
                                <p id="modal_parent_id"
                                    class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono"></p>
                            </div>
                            <div class="bg-gray-100/75 dark:bg-slate-800/30 border p-3 rounded-xl">
                                <p class="text-xs text-slate-700 dark:text-zinc-300 font-medium">الرسوم المطلوبة / المدفوعة
                                </p>
                                <p id="modal_fees"
                                    class="text-sm font-bold text-slate-700 dark:text-zinc-200 mt-1 font-mono"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="flex flex-wrap items-center justify-center gap-1.5 sm:gap-2 mt-4 pt-3 border-t border-slate-200 dark:border-slate-800 shrink-0">
                <form id="form_delete_student" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-3 py-2 text-xs font-bold bg-red-50 dark:bg-red-900/50 text-red-600 dark:text-red-400 rounded-xl hover:bg-amber-200 dark:hover:bg-slate-700">
                        <i class="fa-solid fa-archive ml-1"></i> حذف
                    </button>
                </form>
                <button onclick="closeModal('mainStudentModal')"
                    class="px-3 py-2 text-xs font-bold text-gray-500 bg-gray-100 dark:bg-slate-800 rounded-xl hover:bg-gray-200">إغلاق</button>
                <button onclick="switchModal('mainStudentModal', 'editDataModal')"
                    class="px-3 py-2 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-xl flex items-center gap-1"><i
                        class="fa-solid fa-marker"></i> تعديل البيانات</button>
                <button onclick="switchModal('mainStudentModal', 'editClassModal')"
                    class="px-3 py-2 text-xs font-bold text-white bg-blue-600 hover:bg-blue-700 rounded-xl flex items-center gap-1"><i
                        class="fa-solid fa-chalkboard-user"></i> الصف</button>
                <button onclick="switchModal('mainStudentModal', 'editFeesModal')"
                    class="px-3 py-2 text-xs font-bold text-white bg-teal-600 hover:bg-teal-700 rounded-xl flex items-center gap-1"><i
                        class="fa-solid fa-hand-holding-dollar"></i> الرسوم</button>
            </div>
        </div>
    </div>

    <div id="editDataModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('editDataModal')"></div>
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative z-10 p-6 border border-emerald-400">
            <h3 class="text-base font-bold text-amber-600 mb-4"><i class="fa-solid fa-marker"></i> تعديل البيانات الأساسية
            </h3>
            <form id="form_edit_data" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">اسم الطالب رباعي</label>
                    <input type="text" name="full_name" id="input_full_name"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هوية الطالب</label>
                    <input type="text" name="id" id="input_student_id"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم هوية ولي
                        الامر</label>
                    <input type="text" name="parent_id" id="input_parent_id"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">رقم الهاتف الشخصي</label>
                    <input type="text" name="parent_phone" id="input_parent_phone"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="switchModal('editDataModal', 'mainStudentModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 rounded-xl">رجوع</button>
                    <button type="submit"
                        class="px-4 py-2 text-xs font-bold text-white bg-amber-500 rounded-xl">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editClassModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('editClassModal')"></div>
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative z-10 p-6 border border-emerald-400">
            <h3 class="text-base font-bold text-blue-600 mb-4">📚 نقل وتعديل الصف</h3>
            <form id="form_edit_class" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">الصف الدراسي</label>
                    <select name="academic_level" id="input_academic_level" required
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm outline-none text-slate-800 dark:text-zinc-100">
                        <option value="">اختر الصف...</option>
                        <option value="الصف الأول الابتدائي">الصف الأول الابتدائي</option>
                        <option value="الصف الثاني الابتدائي">الصف الثاني الابتدائي</option>
                        <option value="الصف الثالث الابتدائي">الصف الثالث الابتدائي</option>
                        <option value="الصف الرابع الابتدائي">الصف الرابع الابتدائي</option>
                        <option value="الصف الخامس الابتدائي">الصف الخامس الابتدائي</option>
                        <option value="الصف السادس الابتدائي">الصف السادس الابتدائي</option>
                        <option value="الصف السابع">الصف السابع</option>
                        <option value="الصف الثامن">الصف الثامن</option>
                        <option value="الصف التاسع">الصف التاسع</option>
                        <option value="الصف العاشر">الصف العاشر</option>
                        <option value="الصف الحادي عشر">الصف الحادي عشر</option>
                        <option value="توجيهي">توجيهي (الثاني عشر)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">الشعبة</label>
                    <select required name="section_name" id="input_section_name"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2.5 px-3 text-sm outline-none text-slate-800 dark:text-zinc-100">
                        <option value="">اختر الشعبة...</option>
                        <option value="شعبة (أ)">شعبة (أ)</option>
                        <option value="شعبة (ب)">شعبة (ب)</option>
                        <option value="شعبة (ج)">شعبة (ج)</option>
                        <option value="بدون شعبة">بدون شعبة / عام</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="switchModal('editClassModal', 'mainStudentModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 rounded-xl">رجوع</button>
                    <button type="submit"
                        class="px-4 py-2 text-xs font-bold text-white bg-blue-600 rounded-xl">تحديث</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editFeesModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal('editFeesModal')"></div>
        <div
            class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl overflow-hidden relative z-10 p-6 border border-emerald-400">
            <h3 class="text-base font-bold text-teal-600 mb-4">💰 إدارة وتعديل الرسوم المدرسية</h3>
            <form id="form_edit_fees" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-1">إجمالي الرسوم</label>
                    <input type="text" name="total_paid_amount" id="input_total_paid_amount"
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none" />
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="switchModal('editFeesModal', 'mainStudentModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 rounded-xl">رجوع</button>
                    <button type="submit"
                        class="px-4 py-2 text-xs font-bold text-white bg-teal-600 rounded-xl">حفظ</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterForm = document.getElementById('filterForm');

            // 1. عند الضغط على زر Enter داخل حقل البحث
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault(); // منع الفورم من الإرسال التقليدي المكسور
                    filterForm.submit(); // إرسال الفورم كاملاً بالصف والبحث معاً
                }
            });

            // 2. الحل الحاسم لمشكلة مسح الاسم:
            // عند تغيير النص، لو أصبح الحقل فارغاً تماماً (تم مسحه بالكامل) سيرسل الفورم فوراً ليحتفظ بالصف المختار ويعيد بقية الطلاب
            searchInput.addEventListener('input', function() {
                if (this.value.trim() === '') {
                    filterForm.submit();
                }
            });

            // 3. مستمع لزر الـ X الصغير الذي يظهر في المتصفحات لمسح الحقل دفعة واحدة
            searchInput.addEventListener('search', function() {
                if (this.value.trim() === '') {
                    filterForm.submit();
                }
            });
        });
    </script>
    <script>
        function openStudentModal(student) {
            // 1. حقن البيانات في المودال الرئيسي لعرض ملف الطالب التفصيلي
            document.getElementById('modal_avatar').innerText = student.full_name.substring(0, 1);
            document.getElementById('modal_full_name').innerText = student.full_name;
            document.getElementById('modal_student_code').innerText = student.student_code;
            document.getElementById('modal_academic_badge').innerText =
                `${student.academic_level} - ${student.section_name}`;

            // استخراج اسم ولي الأمر (حذف أول اسم من الاسم الرباعي)
            let nameParts = student.full_name.split(' ');
            let parentName = nameParts.slice(1).join(' ');
            document.getElementById('modal_parent_name').innerText = parentName || student.full_name;

            document.getElementById('modal_parent_phone').innerText = student.parent_phone;
            document.getElementById('modal_student_id').innerText = student.id;
            document.getElementById('modal_parent_id').innerText = student.parent_id;
            document.getElementById('modal_fees').innerText =
                `₪${student.total_paid_amount} / ₪${student.total_required_fees}`;

            // 2. تجهيز وتهيئة قيم فورم تعديل البيانات الأساسية
            document.getElementById('input_full_name').value = student.full_name;
            document.getElementById('input_student_id').value = student.id;
            document.getElementById('input_parent_id').value = student.parent_id;
            document.getElementById('input_parent_phone').value = student.parent_phone;
            document.getElementById('form_edit_data').action =
                `/students/${student.id}`; // قم بتغيير مسار الـ Route حسب التسمية لديك

            // 3. تجهيز فورم تعديل الصف والشعبة
            document.getElementById('input_academic_level').value = student.academic_level;
            document.getElementById('input_section_name').value = student.section_name;
            document.getElementById('form_edit_class').action =
                `/students/edit-class/${student.id}`; // عدّل الـ URL حسب الـ routes عندك

            // 4. تجهيز فورم تعديل الرسوم
            // تغيير التجهيز ليقرأ "إجمالي المطلوب الحقيقي" المحدث من السيرفر
            document.getElementById('input_total_paid_amount').value = student.total_required_fees;

            document.getElementById('form_edit_fees').action = `/students/edit-fees/${student.id}`;
            // سيقوم بتحويل الرابط ديناميكياً إلى /students/5 مثلاً
            document.getElementById('form_delete_student').action = `/students/${student.id}`; // 5. إظهار المودال الرئيسي
            openModal('mainStudentModal');
        }

        // الدوال المساعدة الخاصة بك لفتح وإغلاق المودالات
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }

        function switchModal(closeId, openId) {
            closeModal(closeId);
            openModal(openId);
        }
    </script>
@endsection
