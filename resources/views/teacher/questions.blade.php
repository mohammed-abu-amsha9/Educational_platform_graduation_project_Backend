@extends('teacher.parent')
@section('title', 'بنك الاسالة')
@section('content')
    <div class="my-6 mx-auto space-y-6" dir="rtl">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-4 transition-all">
            <div class="w-full md:w-auto flex flex-col sm:flex-row items-center gap-4 flex-1 justify-start">
                <div class="w-full sm:w-64">
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 mb-1">المادة
                        والصف</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:border-teal-500 cursor-pointer">
                        <option value="1">اللغة العربية - الصف الأول الإعدادي</option>
                        <option value="2">اللغة العربية - الصف الثاني الإعدادي</option>
                    </select>
                </div>
                <div class="w-full sm:w-48">
                    <label class="block text-[10px] font-bold text-gray-700 dark:text-slate-400 mb-1">نوع
                        السؤال</label>
                    <select
                        class="w-full border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-xs outline-none focus:border-teal-500 cursor-pointer">
                        <option value="all">كل الأنواع</option>
                        <option value="mcq">اختيار من متعدد</option>
                        <option value="tf">صح أو خطأ</option>
                    </select>
                </div>
            </div>
            <button id="openModalBtn" type="button"
                class="w-full md:w-auto bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs px-6 py-3 rounded-xl flex items-center justify-center gap-2 transition shadow-lg shadow-teal-600/10 cursor-pointer shrink-0">
                <i class="fa-solid fa-plus"></i>
                <span>إضافة سؤال جديد</span>
            </button>
        </div>

        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-4 transition-all">
            <div class="flex items-center justify-between border-b border-gray-100 dark:border-slate-800 pb-4">
                <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                    الأسئلة المخزنة (<span>1</span>)
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse text-xs">
                    <thead>
                        <tr
                            class="border-b border-gray-100 dark:border-slate-800 text-gray-700 dark:text-gray-500 font-bold">
                            <th class="pb-3 pl-4">نص السؤال</th>
                            <th class="pb-3 px-4 w-40">النوع</th>
                            <th class="pb-3 px-4 w-28">الصعوبة</th>
                            <th class="pb-3 pr-4 w-24 text-left">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60">
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 transition-colors">
                            <td class="py-4 pl-4 font-medium text-slate-800 dark:text-zinc-200">
                                ما هو الفاعل في جملة "جاء الحقُ وزهق الباطلُ"؟
                            </td>
                            <td class="py-4 px-4">
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-950/40 dark:text-blue-400 font-bold text-[10px]">
                                    <i class="fa-solid fa-list-ul ml-1"></i> اختيار من متعدد
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <span
                                    class="px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-950/30 dark:text-emerald-400 font-bold text-[10px]">سهل</span>
                            </td>
                            <td class="py-4 pr-4 text-left">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button"
                                        class="openEditModalBtn w-8 h-8 rounded-lg border border-gray-200 dark:border-slate-800 text-gray-500 dark:text-zinc-400 hover:text-amber-600 hover:border-amber-500 transition-colors cursor-pointer">
                                        <i class="fa-solid fa-pen text-[11px]"></i>
                                    </button>
                                    <button type="button"
                                        class="w-8 h-8 rounded-lg border border-gray-200 dark:border-slate-800 text-gray-500 dark:text-zinc-400 hover:text-rose-600 hover:border-rose-500 transition-colors cursor-pointer">
                                        <i class="fa-solid fa-trash text-[11px]"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="questionModal"
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 hidden"
            dir="rtl">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 w-full max-w-2xl rounded-3xl shadow-xl overflow-hidden transition-all my-8">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                        <i class="fa-solid fa-circle-plus text-teal-600"></i>
                        <span>إضافة سؤال جديد للبنك</span>
                    </h3>
                    <button id="closeModalCross" type="button"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-250 text-sm cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="#" method="POST" class="p-6 space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-gray-500 dark:text-slate-400 mb-1">نص السؤال *</label>
                        <textarea rows="3" required placeholder="اكتب هنا نص السؤال التقييمي..."
                            class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 transition-colors resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-500 dark:text-slate-400 mb-1">نوع
                                السؤال</label>
                            <select id="questionTypeSelect"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 cursor-pointer">
                                <option value="mcq">اختيار من متعدد (MCQ)</option>
                                <option value="tf">صح أو خطأ</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-500 dark:text-slate-400 mb-1">مستوى
                                الصعوبة</label>
                            <select
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 cursor-pointer">
                                <option value="easy">سهل</option>
                                <option value="medium">متوسط</option>
                                <option value="hard">صعب</option>
                            </select>
                        </div>
                    </div>

                    <div id="mcqSection" class="space-y-3 pt-2">
                        <label
                            class="block font-bold text-slate-700 dark:text-zinc-300 border-b border-gray-100 dark:border-slate-800 pb-2">
                            <i class="fa-solid fa-list-ul text-blue-500 ml-1"></i> إعدادات
                            خيارات الإجابة (للاختيار من متعدد):
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="radio" name="correct_answer" value="1" checked
                                class="w-4 h-4 accent-teal-600 cursor-pointer" />
                            <input type="text" placeholder="الخيار الأول"
                                class="flex-1 border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 outline-none focus:border-teal-500 transition-colors" />
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" name="correct_answer" value="2"
                                class="w-4 h-4 accent-teal-600 cursor-pointer" />
                            <input type="text" placeholder="الخيار الثاني"
                                class="flex-1 border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 outline-none focus:border-teal-500 transition-colors" />
                        </div>
                    </div>

                    <div id="tfSection" class="space-y-3 pt-2 hidden">
                        <label
                            class="block font-bold text-slate-700 dark:text-zinc-300 border-b border-gray-100 dark:border-slate-800 pb-2">
                            <i class="fa-solid fa-circle-check text-purple-500 ml-1"></i>
                            تحديد الإجابة الصحيحة (لنوع صح أو خطأ):
                        </label>
                        <div
                            class="flex items-center gap-6 bg-gray-50 dark:bg-slate-950 p-3 rounded-xl border border-gray-100 dark:border-slate-800/60">
                            <label
                                class="flex items-center gap-2 font-bold text-slate-700 dark:text-zinc-300 cursor-pointer">
                                <input type="radio" name="tf_correct" value="true"
                                    class="w-4 h-4 accent-teal-600" />
                                <span>العبارة (صح)</span>
                            </label>
                            <label
                                class="flex items-center gap-2 font-bold text-slate-700 dark:text-zinc-300 cursor-pointer">
                                <input type="radio" name="tf_correct" value="false"
                                    class="w-4 h-4 accent-teal-600" />
                                <span>العبارة (خطأ)</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-slate-800 flex justify-end gap-2">
                        <button id="closeModalBtn" type="button"
                            class="bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-600 dark:text-zinc-300 font-bold px-5 py-2.5 rounded-xl transition cursor-pointer">
                            إلغاء
                        </button>
                        <button type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-5 py-2.5 rounded-xl transition shadow-lg shadow-teal-600/10 cursor-pointer">
                            حفظ السؤال بالبنك
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div id="editQuestionModal"
            class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/50 backdrop-blur-sm flex items-center justify-center p-4 hidden"
            dir="rtl">
            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 w-full max-w-2xl rounded-3xl shadow-xl overflow-hidden transition-all my-8">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
                    <h3 class="text-sm font-black text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                        <i class="fa-solid fa-pen-to-square text-amber-500"></i>
                        <span>تعديل بيانات السؤال الشامل</span>
                    </h3>
                    <button id="closeEditCross" type="button"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-250 text-sm cursor-pointer">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form action="#" method="POST" class="p-6 space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-gray-500 dark:text-slate-400 mb-1">نص السؤال المراد
                            تعديله *</label>
                        <textarea rows="3" required
                            class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-amber-500 transition-colors resize-none">
ما هو الفاعل في جملة "جاء الحقُ وزهق الباطلُ"؟</textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-gray-500 dark:text-slate-400 mb-1">نوع
                                السؤال</label>
                            <select id="editQuestionTypeSelect"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-amber-500 cursor-pointer">
                                <option value="mcq" selected>اختيار من متعدد (MCQ)</option>
                                <option value="tf">صح أو خطأ</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-500 dark:text-slate-400 mb-1">مستوى
                                الصعوبة</label>
                            <select
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-amber-500 cursor-pointer">
                                <option value="easy">سهل</option>
                                <option value="medium">متوسط</option>
                                <option value="hard">صعب</option>
                            </select>
                        </div>
                    </div>

                    <div id="editMcqSection" class="space-y-3 pt-2">
                        <label
                            class="block font-bold text-slate-700 dark:text-zinc-300 border-b border-gray-100 dark:border-slate-800 pb-2">تعديل
                            خيارات الإجابة:</label>
                        <div class="flex items-center gap-3">
                            <input type="radio" name="edit_correct_answer" value="1" checked
                                class="w-4 h-4 accent-amber-500 cursor-pointer" />
                            <input type="text" value="الحقُ"
                                class="flex-1 border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 outline-none focus:border-amber-500 transition-colors" />
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="radio" name="edit_correct_answer" value="2"
                                class="w-4 h-4 accent-amber-500 cursor-pointer" />
                            <input type="text" value="جاء"
                                class="flex-1 border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 outline-none focus:border-amber-500 transition-colors" />
                        </div>
                    </div>

                    <div id="editTfSection" class="space-y-3 pt-2 hidden">
                        <label
                            class="block font-bold text-slate-700 dark:text-zinc-300 border-b border-gray-100 dark:border-slate-800 pb-2">تعديل
                            الإجابة الصحيحة:</label>
                        <div
                            class="flex items-center gap-6 bg-gray-50 dark:bg-slate-950 p-3 rounded-xl border border-gray-100 dark:border-slate-800/60">
                            <label
                                class="flex items-center gap-2 font-bold text-slate-700 dark:text-zinc-300 cursor-pointer">
                                <input type="radio" name="edit_tf_correct" value="true"
                                    class="w-4 h-4 accent-amber-500" />
                                <span>العبارة (صح)</span>
                            </label>
                            <label
                                class="flex items-center gap-2 font-bold text-slate-700 dark:text-zinc-300 cursor-pointer">
                                <input type="radio" name="edit_tf_correct" value="false"
                                    class="w-4 h-4 accent-amber-500" />
                                <span>العبارة (خطأ)</span>
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-slate-800 flex justify-end gap-2">
                        <button id="closeEditBtn" type="button"
                            class="bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-600 dark:text-zinc-300 font-bold px-5 py-2.5 rounded-xl transition cursor-pointer">
                            إلغاء
                        </button>
                        <button type="submit"
                            class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-5 py-2.5 rounded-xl transition shadow-lg shadow-amber-500/10 cursor-pointer">
                            تحديث البيانات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // --- 1) إدارة مودال الإضافة (Create Modal) ---
            const createModal = document.getElementById("questionModal");
            const openCreateBtn = document.getElementById("openModalBtn");
            const closeCreateBtn = document.getElementById("closeModalBtn");
            const closeCreateCross = document.getElementById("closeModalCross");

            const createTypeSelect = document.getElementById("questionTypeSelect");
            const createMcqSection = document.getElementById("mcqSection");
            const createTfSection = document.getElementById("tfSection");

            openCreateBtn.addEventListener("click", () =>
                createModal.classList.remove("hidden"),
            );
            [closeCreateBtn, closeCreateCross].forEach((btn) =>
                btn.addEventListener("click", () =>
                    createModal.classList.add("hidden"),
                ),
            );

            function toggleCreateSections() {
                const val = createTypeSelect.value;
                [createMcqSection, createTfSection].forEach((s) =>
                    s.classList.add("hidden"),
                );
                if (val === "mcq") createMcqSection.classList.remove("hidden");
                if (val === "tf") createTfSection.classList.remove("hidden");
            }
            createTypeSelect.addEventListener("change", toggleCreateSections);
            toggleCreateSections();

            // --- 2) إدارة مودال التعديل المنفصل (Edit Modal) ---
            const editModal = document.getElementById("editQuestionModal");
            const openEditButtons = document.querySelectorAll(".openEditModalBtn");
            const closeEditBtn = document.getElementById("closeEditBtn");
            const closeEditCross = document.getElementById("closeEditCross");

            const editTypeSelect = document.getElementById(
                "editQuestionTypeSelect",
            );
            const editMcqSection = document.getElementById("editMcqSection");
            const editTfSection = document.getElementById("editTfSection");

            openEditButtons.forEach((btn) => {
                btn.addEventListener("click", () =>
                    editModal.classList.remove("hidden"),
                );
            });
            [closeEditBtn, closeEditCross].forEach((btn) =>
                btn.addEventListener("click", () =>
                    editModal.classList.add("hidden"),
                ),
            );

            function toggleEditSections() {
                const val = editTypeSelect.value;
                [editMcqSection, editTfSection].forEach((s) =>
                    s.classList.add("hidden"),
                );
                if (val === "mcq") editMcqSection.classList.remove("hidden");
                if (val === "tf") editTfSection.classList.remove("hidden");
            }
            editTypeSelect.addEventListener("change", toggleEditSections);
            toggleEditSections();
        });
    </script>
@endsection
