@extends('admin.parent')
@section('title', 'المعلمون')
@section('content')
    <div class="my-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

                {{-- فورم إضافة معلم --}}
                <div class="lg:col-span-4 order-1">
                    <div
                        class="bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 sticky top-8">
                        <div class="flex items-center gap-2 mb-6">
                            <div
                                class="w-8 h-8 bg-blue-50 dark:bg-blue-950/40 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <i class="fa-solid fa-plus text-sm"></i>
                            </div>
                            <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100">تسجيل معلم جديد</h2>
                        </div>

                        <form method="POST" action="{{ route('teachers.store') }}" class="space-y-4">
                            @csrf

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                    المعلم</label>
                                <input type="text" name="full_name" placeholder="الاسم الكامل" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-100" />
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">رقم الهوية</label>
                                <input type="number" name="id" placeholder="000000000" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 font-mono text-slate-800 dark:text-zinc-100" />
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">رقم
                                    الهاتف</label>
                                <input type="text" name="phone_number" placeholder="0599999999" required
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 font-mono text-slate-800 dark:text-zinc-100" />
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-2 uppercase">المواد
                                    الموكلة للمعلم:</label>
                                <div
                                    class="grid grid-cols-2 gap-2 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl p-3 max-h-40 overflow-y-auto custom-scroll">
                                    @foreach ($subjects as $subject)
                                        <label class="flex items-center gap-2 cursor-pointer py-1 group">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                                                class="w-4 h-4 accent-teal-600 cursor-pointer" />
                                            <span
                                                class="text-xs text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 transition-colors">
                                                {{ $subject->name }}
                                                <span
                                                    class="text-[10px] text-gray-400">({{ $subject->grade->name ?? '' }})</span>
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-zinc-300 mb-2">الصفوف والشعب
                                    المسندة</label>
                                <div class="border border-gray-200 dark:border-slate-800 rounded-xl p-3 space-y-1.5 text-xs bg-slate-50/50 dark:bg-slate-800/30 custom-scroll"
                                    style="height:150px; overflow-y:scroll;">
                                    @foreach ($grades as $grade)
                                        @if ($grade->sections->count() > 0)
                                            @foreach ($grade->sections as $section)
                                                <label
                                                    class="flex items-center justify-between py-0.5 cursor-pointer group">
                                                    <span
                                                        class="text-slate-600 dark:text-zinc-400 group-hover:text-teal-600 transition-colors">
                                                        {{ $grade->name }} — {{ $section->name }}
                                                    </span>
                                                    <input type="checkbox" name="sections[]" value="{{ $section->id }}"
                                                        class="w-3.5 h-3.5 accent-teal-500 cursor-pointer" />
                                                </label>
                                            @endforeach
                                        @else
                                            <label class="flex items-center justify-between py-0.5 cursor-pointer group">
                                                <span
                                                    class="text-slate-600 dark:text-zinc-400 group-hover:text-teal-600 transition-colors font-bold">
                                                    {{ $grade->name }} — (عام / بدون شعبة)
                                                </span>
                                                <input type="checkbox" name="grades[]" value="{{ $grade->id }}"
                                                    class="w-3.5 h-3.5 accent-teal-500 cursor-pointer" />
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">الدور
                                    الوظيفي (الصلاحيات)</label>
                                <select name="role_id" required
                                    class="w-full border border-gray-200 dark:border-slate-800 rounded-xl p-3 text-xs bg-slate-50/50 dark:bg-slate-800/30 text-slate-800 dark:text-zinc-300 focus:outline-none cursor-pointer focus:ring-2 focus:ring-teal-600">
                                    <option value="" disabled selected>اختر الدور المرتبط بالمعلم...</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-teal-700/20 flex items-center justify-center gap-2 mt-4 transition-all">
                                <i class="fa-solid fa-save"></i>
                                <span>حفظ المعلم</span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- قائمة المعلمين --}}
                <div
                    class="lg:col-span-8 bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 order-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                            <span>قائمة المعلمين</span>
                            <span
                                class="bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-400 text-xs px-2 py-1 rounded-full">
                                {{ $teachers->count() }}
                            </span>
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($teachers as $teacher)
                            <div onclick="openViewModal({{ json_encode($teacher->load(['subjects', 'sections', 'grades', 'role'])) }})"
                                class="group relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md cursor-pointer transition-all">

                                <span
                                    class="absolute top-4 left-4 bg-emerald-50 dark:bg-emerald-950/30 text-emerald-600 dark:text-emerald-400 text-[10px] font-bold px-2.5 py-1 rounded-full">نشط</span>

                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-14 h-14 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl shadow-inner">
                                        {{ mb_substr($teacher->full_name, 0, 1) }}
                                    </div>

                                    <div>
                                        <h3 class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600">
                                            {{ $teacher->full_name }}
                                        </h3>
                                        <p class="text-xs text-gray-400 font-mono">{{ $teacher->teacher_code }}</p>

                                        <div
                                            class="flex flex-wrap gap-x-4 gap-y-1 mt-2 text-[11px] text-gray-500 dark:text-zinc-400">
                                            <span>
                                                <i class="fa-solid fa-book-open ml-1 text-teal-500"></i>
                                                {{ $teacher->subjects->pluck('name')->implode('، ') ?: 'لم تحدد مواد' }}
                                            </span>
                                            <span>
                                                <i class="fa-solid fa-key ml-1 text-amber-500"></i>
                                                {{ $teacher->role->role_name ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 text-center py-16 text-gray-400 text-sm">
                                <i class="fa-solid fa-chalkboard-user text-3xl mb-3 block"></i>
                                لا يوجد معلمون مسجلون بعد
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ==================== 1. مودال العرض ==================== --}}
    <div id="viewModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('viewModal')"></div>
        <div id="viewContent"
            class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl relative z-10 p-6 transform scale-95 opacity-0 transition-all duration-300">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-lg font-black text-teal-700">ملف المعلم</h2>
                <button onclick="closeModal('viewModal')" class="text-gray-400 hover:text-rose-500 transition-colors">
                    <i class="fa-solid fa-circle-xmark text-xl"></i>
                    </< /button>
            </div>

            <div class="flex flex-col items-center text-center mb-6">
                <div id="vAvatar"
                    class="w-20 h-20 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 font-black text-3xl mb-3 shadow-inner">
                </div>
                <h3 id="vName" class="text-xl font-black text-slate-800 dark:text-zinc-100"></h3>
                <span id="vId"
                    class="text-xs font-mono text-gray-400 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded mt-1"></span>
            </div>

            <div class="grid grid-cols-1 gap-3 mb-8">
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">المادة المدرّسة</span>
                    <span id="vSubject" class="text-sm font-bold text-slate-700 dark:text-zinc-200"></span>
                </div>
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">رقم الهاتف</span>
                    <span id="vPhone" class="text-sm font-bold text-slate-700 dark:text-zinc-200"></span>
                </div>
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">الصفوف</span>
                    <span id="vClasses" class="text-sm font-bold text-slate-700 dark:text-zinc-200"></span>
                </div>
                <div
                    class="flex justify-between p-3 bg-slate-50 dark:bg-slate-800/40 rounded-xl border border-gray-100 dark:border-slate-800">
                    <span class="text-gray-400 text-xs">الدور الوظيفي</span>
                    <span id="vPerms" class="text-sm font-bold text-slate-700 dark:text-zinc-200"></span>
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

    {{-- ==================== 2. مودال التعديل ==================== --}}
    <div id="editModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('editModal')"></div>
        <div
            class="bg-white border border-emerald-400 dark:bg-slate-900 rounded-3xl w-full max-w-md shadow-2xl relative z-10 p-6 max-h-[90vh] flex flex-col">

            <h2 class="text-lg font-black text-amber-600 mb-4 flex items-center gap-2 shrink-0">
                <i class="fa-solid fa-pen-to-square"></i> تعديل بيانات المعلم
            </h2>

            <form method="POST" action="" id="editTeacherForm"
                class="space-y-4 overflow-y-auto pr-1 flex-1 custom-scroll">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">اسم المعلم</label>
                    <input type="text" id="edit_full_name" name="full_name" required
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none dark:text-zinc-100" />
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-2 uppercase">المواد
                        الموكلة للمعلم:</label>
                    <div
                        class="grid grid-cols-2 gap-2 border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl p-3 max-h-40 overflow-y-auto custom-scroll">
                        @foreach ($subjects as $subject)
                            <label class="flex items-center gap-2 cursor-pointer py-1 group">
                                <input type="checkbox" name="subjects[]" value="{{ $subject->id }}"
                                    data-subject-id="{{ $subject->id }}"
                                    class="edit-subject-checkbox w-4 h-4 accent-teal-600 cursor-pointer" />
                                <span
                                    class="text-xs text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 transition-colors">
                                    {{ $subject->name }}
                                    <span class="text-[10px] text-gray-400">({{ $subject->grade->name ?? '' }})</span>
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1">رقم الهاتف</label>
                    <input type="text" id="edit_phone" name="phone_number" required
                        class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 rounded-xl py-2 px-3 text-sm outline-none dark:text-zinc-100 font-mono" />
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-500 mb-1.5 uppercase">الصفوف والشعب
                        الدراسية</label>
                    <div class="border border-gray-100 dark:border-slate-800 rounded-xl p-3 space-y-3 text-xs bg-slate-50/50 dark:bg-slate-800/30 custom-scroll"
                        style="height:160px; overflow-y:scroll;">
                        @foreach ($grades as $grade)
                            @php $hasSections = $grade->sections && $grade->sections->count() > 0; @endphp

                            @if ($hasSections)
                                <div
                                    class="space-y-1 bg-slate-100/30 dark:bg-slate-800/20 p-2 rounded-lg border border-gray-100/80 dark:border-slate-800/50">
                                    <div
                                        class="text-[10px] font-bold text-teal-600 dark:text-teal-400 bg-teal-50/50 dark:bg-teal-950/30 px-2 py-1 rounded-md flex items-center justify-between">
                                        <span class="flex items-center">
                                            <i class="fa-solid fa-graduation-cap ml-1"></i> {{ $grade->name }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 gap-2 pr-2 pt-1">
                                        @foreach ($grade->sections as $section)
                                            <label
                                                class="flex items-center py-1 px-2 border border-gray-100/50 dark:border-slate-800/40 rounded-md bg-white dark:bg-slate-900/40 cursor-pointer hover:bg-slate-50 transition-colors">
                                                <input type="checkbox" name="sections[]" value="{{ $section->id }}"
                                                    data-section-id="{{ $section->id }}"
                                                    class="edit-section-checkbox ml-2 rounded border-gray-300 text-teal-600 focus:ring-teal-500 dark:border-slate-700 dark:bg-slate-900">
                                                <span class="text-slate-600 dark:text-zinc-300">شعبة
                                                    ({{ $section->name }})
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <label
                                    class="flex items-center justify-between py-2 px-3 border border-gray-200/60 dark:border-slate-800 rounded-xl cursor-pointer hover:bg-slate-100/40 dark:hover:bg-slate-800/40 transition-colors">
                                    <span class="flex items-center text-slate-700 dark:text-zinc-300 font-medium">
                                        <input type="checkbox" name="grades[]" value="{{ $grade->id }}"
                                            data-grade-id="{{ $grade->id }}"
                                            class="edit-grade-checkbox ml-2 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-900">
                                        <i class="fa-solid fa-graduation-cap ml-1 text-slate-400"></i> {{ $grade->name }}
                                    </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">الدور
                        الوظيفي (الصلاحيات)</label>
                    <select id="edit_role_id" name="role_id" required
                        class="w-full border border-gray-100 dark:border-slate-800 rounded-xl p-3 text-xs bg-slate-50/50 dark:bg-slate-800/30 text-gray-600 dark:text-zinc-300 focus:outline-none cursor-pointer">
                        <option value="" disabled>اختر الدور...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-slate-800 shrink-0">
                    <button type="button" onclick="switchModal('editModal', 'viewModal')"
                        class="px-4 py-2 text-xs font-bold text-gray-400 bg-gray-100 dark:bg-slate-800 rounded-xl cursor-pointer">رجوع</button>
                    <button type="submit"
                        class="px-4 py-2 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 rounded-xl cursor-pointer transition-colors">حفظ
                        التغييرات</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ==================== 3. مودال الحذف ==================== --}}
    <div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeModal('deleteModal')"></div>
        <div class="bg-white dark:bg-slate-900 rounded-3xl w-full max-w-xs shadow-2xl relative z-10 p-6 text-center">
            <div
                class="w-16 h-16 bg-rose-50 dark:bg-rose-950 text-rose-500 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="text-lg font-black text-slate-800 dark:text-zinc-100 mb-2">حذف المعلم؟</h3>
            <p class="text-xs text-gray-400 mb-6 leading-relaxed">أنت على وشك حذف بيانات هذا المعلم نهائياً من النظام، هل
                تريد الاستمرار؟</p>
            <div class="flex gap-2">
                <button onclick="closeModal('deleteModal')"
                    class="flex-1 py-3 text-sm font-bold text-gray-500 bg-slate-100 dark:bg-slate-800 rounded-xl">تراجع</button>
                <form id="deleteTeacherForm" method="POST" action="" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="w-full py-3 text-sm font-bold text-white bg-rose-500 hover:bg-rose-600 rounded-xl">نعم،
                        احذف</button>
                </form>
            </div>
        </div>
    </div>

    {{-- ==================== كود الجافاسكربت المطور في أسفل الصفحة ==================== --}}
    <script>
        let currentTeacherData = null;

        function openViewModal(teacher) {
            currentTeacherData = teacher;

            // 1. تعبئة مودال العرض (View Modal)
            document.getElementById('vName').innerText = teacher.full_name;
            document.getElementById('vId').innerText = teacher.teacher_code;
            document.getElementById('vPhone').innerText = teacher.phone_number;
            document.getElementById('vAvatar').innerText = teacher.full_name.substring(0, 1);
            document.getElementById('vPerms').innerText = teacher.role ? teacher.role.role_name : '-';
            document.getElementById('vSubject').innerText = teacher.subjects.map(s => s.name).join('، ') || 'لم تحدد';
            document.getElementById('vClasses').innerText = teacher.grades.map(s => s.name).join('، ') || 'لم تحدد';

            // 2. تعبئة حقول مودال التعديل (Edit Modal) تجهيزاً لفتحه لاحقاً
            document.getElementById('edit_full_name').value = teacher.full_name;
            document.getElementById('edit_phone').value = teacher.phone_number;
            document.getElementById('edit_role_id').value = teacher.role_id;
            document.getElementById('editTeacherForm').action = `/admin/teachers/${teacher.id}`;
            document.getElementById('deleteTeacherForm').action = `/admin/teachers/${teacher.id}`;

            // استخراج المعرفات (IDs) وتحويلها دائماً إلى أرقام لضمان مطابقتها
            const teacherSubjectIds = teacher.subjects ? teacher.subjects.map(s => Number(s.id)) : [];
            const teacherSectionIds = teacher.sections ? teacher.sections.map(s => Number(s.id)) : [];

            // ملاحظة: إذا كانت علاقة الصفوف بدون شعب مسجلة باسم grades أو مدمجة في العلاقة، نضمن جلبها هنا
            const teacherGradeIds = teacher.grades ? teacher.grades.map(g => Number(g.id)) : [];
            // ضبط الـ Checkboxes الخاصة بالمواد
            document.querySelectorAll('.edit-subject-checkbox').forEach(cb => {
                const id = Number(cb.getAttribute('data-subject-id'));
                cb.checked = teacherSubjectIds.includes(id);
            });

            // ضبط الـ Checkboxes الخاصة بالشعب
            document.querySelectorAll('.edit-section-checkbox').forEach(cb => {
                const id = Number(cb.getAttribute('data-section-id'));
                cb.checked = teacherSectionIds.includes(id);
            });

            // ضبط الـ Checkboxes الخاصة بالصفوف (بدون شعب)
            document.querySelectorAll('.edit-grade-checkbox').forEach(cb => {
                const id = Number(cb.getAttribute('data-grade-id'));
                cb.checked = teacherGradeIds.includes(id);
            });

            // إظهار المودال الأول
            const modal = document.getElementById('viewModal');
            modal.classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('viewContent').classList.remove('scale-95', 'opacity-0');
            }, 50);
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modalId === 'viewModal') {
                document.getElementById('viewContent').classList.add('scale-95', 'opacity-0');
            }
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function switchModal(fromId, toId) {
            closeModal(fromId);
            setTimeout(() => {
                const toModal = document.getElementById(toId);
                toModal.classList.remove('hidden');
            }, 250);
        }
    </script>

@endsection
