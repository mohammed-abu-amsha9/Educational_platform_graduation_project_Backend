@extends('admin.parent')
@section('title', 'المواد')
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
                                إنشاء مادة جديدة
                            </h2>
                        </div>
                        <form method="POST" action="{{ route('subjects.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <label
                                    class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                    المادة
                                </label>
                                <input name="subject_name" type="text" placeholder="مثال:رياضيات"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 -all text-gray-400 dark:text-zinc-400" />
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-700 dark:text-zinc-300 mb-1.5">الصف
                                    المرتبط</label>
                                <select name="grade_id"
                                    class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800 text-slate-800 dark:text-zinc-300  rounded-xl py-2.5 px-4 text-xs outline-none cursor-pointer focus:border-teal-500">
                                    <option value="">اختر الصف الذي تريد ربطه في المادة...</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit"
                                class="w-full bg-teal-700 hover:bg-teal-800 text-white font-bold py-3 rounded-xl shadow-lg shadow-teal-700/20 -all flex items-center justify-center gap-2 mt-4">
                                <i class="fa-solid fa-save"></i>
                                <span>حفظ المادة</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div
                    class="lg:col-span-8 bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-emerald-400 dark:border-slate-800/80 shadow-xl rounded-2xl p-6 order-2">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-lg font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                            <span> المواد</span>
                            <span
                                class="bg-teal-100 dark:bg-teal-900/40 text-teal-700 dark:text-teal-400 text-xs px-2 py-1 rounded-full"
                                id="teacherCount">{{ $subjects->count() }}</span>
                        </h2>
                    </div>

                    @forelse ($subjects as $subjectGrade)
                        <div
                            class="group mt-2 relative bg-white dark:bg-slate-900 border border-gray-200/60 hover:border-gray-300 dark:border-slate-800/80 p-5 rounded-2xl shadow-sm hover:shadow-md -all">

                            <div class="absolute top-4 left-4 flex items-center gap-2">

                                <button
                                    onclick="openEditsubjectModal('{{ $subjectGrade->id }}', '{{ $subjectGrade->name }}', '{{ $subjectGrade->grade_id }}')"
                                    class="bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 text-[11px] font-bold px-3 py-1.5 rounded-xl border border-gray-200/50 dark:border-slate-700  cursor-pointer flex items-center gap-1">
                                    <i class="fa-solid fa-pen-to-square text-gray-400 dark:text-slate-400 text-[10px]"></i>
                                    <span>تعديل</span>
                                </button>

                                <form method="POST" class="m-0"
                                    action="{{ route('subjects.destroy', $subjectGrade->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-[11px] font-bold bg-red-50 dark:bg-red-900/50 text-red-600 dark:text-red-400 rounded-xl hover:bg-red-100 dark:hover:bg-red-900 border border-red-200/30  flex items-center gap-1 cursor-pointer">
                                        <i class="fa-solid fa-trash-can text-[10px]"></i>
                                        <span>حذف</span>
                                    </button>
                                </form>

                            </div>

                            <div class="flex items-start gap-4">
                                <div class="w-full">
                                    <h3
                                        class="font-bold text-slate-800 dark:text-zinc-100 group-hover:text-teal-600 -colors text-sm">
                                        {{ $subjectGrade->name }}
                                    </h3>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-gray-500">
                                        <span> {{ $subjectGrade->grade->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-span-2 text-center py-16 text-gray-400 text-sm">
                                <i class="fa-solid fa-book text-3xl mb-3 block"></i>
                                لا توجد مواد مسجلة بعد
                            </div>
                        @endforelse

                        <div id="editsubjectModal"
                            class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm ">
                            <div
                                class="bg-white dark:bg-slate-900 border border-emerald-400 rounded-3xl w-full max-w-lg shadow-2xl relative z-10 flex flex-col max-h-[90vh]">
                                <div
                                    class="p-6 pb-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between shrink-0">
                                    <h2 class="text-sm font-black text-teal-600 dark:text-teal-400 flex items-center gap-2">
                                        <i class="fa-solid fa-user-gear text-sm"></i> تعديل المادة
                                    </h2>
                                    <button onclick="closeModal('editsubjectModal')"
                                        class="text-gray-400 hover:text-gray-600 dark:hover:text-white  cursor-pointer text-sm">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <form method="POST" class="p-6 space-y-5 overflow-y-auto flex-1 max-h-[calc(100vh-16rem)]"
                                    id="editsubjectForm">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label
                                            class="block text-[11px] font-black text-slate-700 dark:text-zinc-300 mb-1.5 uppercase">اسم
                                            المادة
                                        </label>
                                        <input name="subject_name" id="modalsubjectName" type="text" placeholder="مثال:أ"
                                            class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-sm outline-none focus:ring-2 focus:ring-teal-600 -all text-gray-400 dark:text-zinc-400" />
                                    </div>
                                    <div>
                                        <label class="block text-[11px] font-bold text-slate-700 dark:text-zinc-300 mb-1.5">الصف
                                            المرتبط</label>
                                        <select name="grade_id" id="modalGradeSelect"
                                            class="w-full border border-gray-200 dark:border-slate-800 bg-white dark:bg-slate-800/50 rounded-xl py-2.5 px-4 text-xs outline-none cursor-pointer focus:border-teal-500">
                                            <option value="">اختر الصف المرتبط هان...</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="flex justify-end gap-2 pt-4 border-t border-gray-100 dark:border-slate-800">
                                        <button type="button" onclick="closeModal('editsubjectModal')"
                                            class="px-5 py-2.5 text-xs font-bold text-gray-500 dark:text-slate-400 bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 dark:hover:text-white rounded-xl  cursor-pointer">
                                            إلغاء
                                        </button>
                                        <button type="submit"
                                            class="px-5 py-2.5 text-xs font-bold text-white dark:text-slate-950 bg-teal-600 hover:bg-teal-700 dark:bg-teal-400 dark:hover:bg-teal-500 rounded-xl  shadow-md shadow-teal-500/10 cursor-pointer">
                                            حفظ التغييرات
                                        </button>
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
        function openEditsubjectModal(id, subjectName, gradeId) {
            // 1. تحديد عناصر الفورم والمودال
            const form = document.getElementById('editsubjectForm');
            const inputsubjectName = document.getElementById('modalsubjectName');
            const selectGrade = document.getElementById('modalGradeSelect');

            // 2. تحديث رابط الإرسال بالمعرف الخاص بالمادة الحالية
            // تأكد من المسار الفعلي للراوت لديك (مثال: /admin/subjects/ )
            form.action = `/admin/subjects/${id}`;

            // 3. تعبئة الحقول بالقيم الحالية
            inputsubjectName.value = subjectName;
            selectGrade.value = gradeId; // سيقوم باختيار الصف المرتبط تلقائياً

            // 4. إظهار المودال
            openModal('editsubjectModal');
        }
    </script>
@endsection
