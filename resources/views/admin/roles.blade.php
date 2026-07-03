@extends('admin.parent')
@section('title', 'الادوار والصلاحيات')
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
                                إنشاء دور جديد
                            </h2>
                        </div>

                        <form method="POST" action="{{ route('roles.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                    الدور
                                </label>
                                <input type="text" name="role_name" placeholder="مثال: معلم لغة عربية"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 -all text-gray-400 dark:text-zinc-400" />
                            </div>
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">الصلاحيات</label>
                                <div
                                    class="border border-gray-100 dark:border-slate-800 rounded-xl p-3 max-h-32 overflow-y-auto space-y-2 text-xs custom-scroll bg-slate-50/50 dark:bg-slate-800/30">
                                    <label class="flex items-center justify-between">
                                        <span class="text-gray-600 dark:text-zinc-300">تسجيل الحضور</span>
                                        <input type="checkbox" name="can_manage_attendance" value="1"
                                            class="accent-blue-600" />
                                    </label>

                                    <label class="flex items-center justify-between">
                                        <span class="text-gray-600 dark:text-zinc-300">رفع ملفات</span>
                                        <input type="checkbox" name="can_upload_files" value="1"
                                            class="accent-blue-600" />
                                    </label>

                                    <label class="flex items-center justify-between">
                                        <span class="text-gray-600 dark:text-zinc-300">إنشاء اختبارات</span>
                                        <input type="checkbox" name="can_create_exams" value="1"
                                            class="accent-blue-600" />
                                    </label>

                                    <label class="flex items-center justify-between">
                                        <span class="text-gray-600 dark:text-zinc-300">تعديل الدرجات</span>
                                        <input type="checkbox" name="can_edit_grades" value="1"
                                            class="accent-blue-600" />
                                    </label>

                                    <label class="flex items-center justify-between">
                                        <span class="text-gray-600 dark:text-zinc-300">الرد على رسائل الطلاب</span>
                                        <input type="checkbox" name="can_reply_messages" value="1"
                                            class="accent-blue-600" />
                                    </label>
                                </div>
                            </div>

                            <button
                                class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-teal-700/20 -all flex items-center justify-center gap-2 mt-4">
                                <i class="fa-solid fa-save"></i>
                                <span>حفظ الدور</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div
                    class="lg:col-span-8 bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 order-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                            <span>الأدوار والصلاحيات</span>
                            <span
                                class="bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-400 text-xs px-2 py-1 rounded-full"
                                id="teacherCount">{{ $roles->count() }}</span>
                        </h2>
                    </div>

                    @forelse($roles as $role)
                        <div
                            class="group mb-4 relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md -all">

                            <button onclick='openEditRoleModal("editRoleModal", @json($role))'
                                class="absolute top-4 left-4 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-[11px] font-bold px-3 py-1.5 rounded-xl border border-gray-200/50 dark:border-slate-700 -all cursor-pointer flex items-center gap-1">
                                <i class="fa-solid fa-pen-to-square text-gray-400 dark:text-slate-400 text-[10px]"></i>
                                <span>تعديل</span>
                            </button>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-14 h-14 rounded-full bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 dark:text-teal-400 font-black text-xl shadow-inner shrink-0">
                                    <i class="fa-solid fa-user-gear"></i>
                                </div>

                                <div class="w-full">
                                    <h3
                                        class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600 -colors text-sm">
                                        {{ $role->role_name }}
                                    </h3>

                                    <div class="flex flex-wrap gap-1.5 mt-4">

                                        @if ($role->can_upload_files)
                                            <span
                                                class="text-[10px] bg-slate-100 dark:bg-slate-800/60 text-slate-650 dark:text-zinc-300 px-2.5 py-1 rounded-lg border border-gray-200/40 dark:border-slate-800 flex items-center gap-1">
                                                <i class="fa-solid fa-file-arrow-up text-teal-500 text-[9px]"></i>
                                                رفع ملفات
                                            </span>
                                        @endif

                                        @if ($role->can_reply_messages)
                                            <span
                                                class="text-[10px] bg-slate-100 dark:bg-slate-800/60 text-slate-650 dark:text-zinc-300 px-2.5 py-1 rounded-lg border border-gray-200/40 dark:border-slate-800 flex items-center gap-1">
                                                <i class="fa-solid fa-envelope-open-text text-amber-500 text-[9px]"></i>
                                                الرد على الرسائل
                                            </span>
                                        @endif

                                        @if ($role->can_manage_attendance)
                                            <span
                                                class="text-[10px] bg-slate-100 dark:bg-slate-800/60 text-slate-650 dark:text-zinc-300 px-2.5 py-1 rounded-lg border border-gray-200/40 dark:border-slate-800 flex items-center gap-1">
                                                <i class="fa-solid fa-clipboard-user text-blue-500 text-[9px]"></i>
                                                رصد الحضور
                                            </span>
                                        @endif

                                        @if ($role->can_create_exams)
                                            <span
                                                class="text-[10px] bg-slate-100 dark:bg-slate-800/60 text-slate-650 dark:text-zinc-300 px-2.5 py-1 rounded-lg border border-gray-200/40 dark:border-slate-800 flex items-center gap-1">
                                                <i class="fa-solid fa-square-poll-vertical text-purple-500 text-[9px]"></i>
                                                إدارة الاختبارات
                                            </span>
                                        @endif

                                        @if ($role->can_edit_grades)
                                            <span
                                                class="text-[10px] bg-slate-100 dark:bg-slate-800/60 text-slate-650 dark:text-zinc-300 px-2.5 py-1 rounded-lg border border-gray-200/40 dark:border-slate-800 flex items-center gap-1">
                                                <i class="fa-solid fa-pen text-red-500 text-[9px]"></i>
                                                تعديل الدرجات
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-16 text-gray-400 text-sm">
                            <i class="fa-solid fa-users-slash text-3xl mb-3 block"></i>
                            لا يوجدأدوار مسجلة بعد
                        </div>
                    @endforelse

                    <!-- مودال التعديل على الدور والصلاحيات -->
                    <div id="editRoleModal"
                        class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm transition-opacity">
                        <div
                            class="bg-white dark:bg-slate-900 border border-emerald-400 rounded-3xl w-full max-w-lg shadow-2xl relative z-10 flex flex-col max-h-[90vh]">

                            <div
                                class="p-6 pb-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between shrink-0">
                                <h2 class="text-sm font-black text-teal-600 dark:text-teal-400 flex items-center gap-2">
                                    <i class="fa-solid fa-user-gear text-sm"></i> تعديل الدور والصلاحيات
                                </h2>
                                <button onclick="closeModal('editRoleModal')"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors cursor-pointer text-sm">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <form method="POST" action=""
                                class="p-6 space-y-5 overflow-y-auto flex-1 max-h-[calc(100vh-16rem)]" id="editRoleForm">
                                @csrf
                                @method('PUT') <div>
                                    <label class="block text-[11px] font-bold text-gray-500 dark:text-slate-400 mb-1.5">اسم
                                        الدور</label>
                                    <input type="text" id="edit_role_name" name="role_name"
                                        class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:border-teal-500 transition-colors" />
                                </div>

                                <div>
                                    <label
                                        class="block text-[11px] font-bold text-gray-500 dark:text-slate-400 mb-2.5 uppercase tracking-wider">
                                        تعديل الصلاحيات الممنوحة
                                    </label>
                                    <div
                                        class="border border-gray-200 dark:border-slate-800/80 rounded-xl p-4 bg-gray-50/50 dark:bg-slate-950/40 space-y-3 text-xs">

                                        <label class="flex items-center justify-between py-1 cursor-pointer group">
                                            <span
                                                class="text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 dark:group-hover:text-white transition-colors">
                                                تسجيل الحضور والغياب
                                            </span>
                                            <input type="checkbox" name="can_manage_attendance"
                                                value="can_manage_attendance"
                                                class="role-permission w-4 h-4 accent-teal-500 cursor-pointer" />
                                        </label>

                                        <label class="flex items-center justify-between py-1 cursor-pointer group">
                                            <span
                                                class="text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 dark:group-hover:text-white transition-colors">
                                                رفع ملفات المادة
                                            </span>
                                            <input type="checkbox" name="can_upload_files" value="can_upload_files"
                                                class="role-permission w-4 h-4 accent-teal-500 cursor-pointer" />
                                        </label>

                                        <label class="flex items-center justify-between py-1 cursor-pointer group">
                                            <span
                                                class="text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 dark:group-hover:text-white transition-colors">
                                                إدارة الاختبارات
                                            </span>
                                            <input type="checkbox" name="can_create_exams" value="can_create_exams"
                                                class="role-permission w-4 h-4 accent-teal-500 cursor-pointer" />
                                        </label>

                                        <label class="flex items-center justify-between py-1 cursor-pointer group">
                                            <span
                                                class="text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 dark:group-hover:text-white transition-colors">
                                                تعديل الدرجات
                                            </span>
                                            <input type="checkbox" name="can_edit_grades" value="can_edit_grades"
                                                class="role-permission w-4 h-4 accent-teal-500 cursor-pointer" />
                                        </label>

                                        <label class="flex items-center justify-between py-1 cursor-pointer group">
                                            <span
                                                class="text-slate-700 dark:text-zinc-300 group-hover:text-teal-600 dark:group-hover:text-white transition-colors">
                                                الرد على الرسائل
                                            </span>
                                            <input type="checkbox" name="can_reply_messages" value="can_reply_messages"
                                                class="role-permission w-4 h-4 accent-teal-500 cursor-pointer" />
                                        </label>

                                    </div>
                                </div>

                                <div
                                    class="p-6 pt-4 border-t border-gray-100 dark:border-slate-800 flex justify-end gap-2 shrink-0">
                                    <button type="button" onclick="closeModal('editRoleModal')"
                                        class="px-5 py-2.5 text-xs font-bold text-gray-500 dark:text-slate-400 bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 dark:hover:text-white rounded-xl transition-all cursor-pointer">إلغاء</button>
                                    <button type="submit"
                                        class="px-5 py-2.5 text-xs font-bold text-white dark:text-slate-950 bg-teal-600 hover:bg-teal-700 dark:bg-teal-400 dark:hover:bg-teal-500 rounded-xl transition-all shadow-md shadow-teal-500/10 cursor-pointer">حفظ
                                        التغييرات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove("hidden");
                document.body.style.overflow = "hidden"; // منع سكرول الخلفية
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add("hidden");
                document.body.style.overflow = "auto"; // إعادة السكرول الطبيعي
            }
        }
    </script>
    <script>
        function openEditRoleModal(modalId, role) {
            openModal(modalId);
            document.getElementById('edit_role_name').value = role.role_name;
            document.getElementById('editRoleForm').action = `/admin/roles/${role.id}`;

            document.querySelectorAll('.role-permission').forEach(checkbox => {
                // role[checkbox.value] بيرجع 1 أو 0 مباشرة من الـ object
                checkbox.checked = role[checkbox.value] == 1;
            });
        }
    </script>
@endsection
