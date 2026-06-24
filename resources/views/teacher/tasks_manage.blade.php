@extends('teacher.parent')
@section('title', 'رفع الواجبات وتصحيحها')
@section('content')

    <div class="my-6 mx-auto space-y-6" dir="rtl">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-4 rounded-3xl shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600">
                    <i class="fa-solid fa-users-viewfinder text-base"></i>
                </div>
                <div>
                    <h2 class="text-sm font-black text-slate-800 dark:text-zinc-100">
                        نظام إدارة وتصحيح الواجبات
                    </h2>
                    <p class="text-[11px] text-gray-400 font-medium">
                        قم برفع واجبات جديدة أو استعرض ملفات الـ PDF المصححة لكل طالب
                        على حدة
                    </p>
                </div>
            </div>

            <div class="flex bg-gray-100 dark:bg-slate-950 p-1 rounded-2xl w-full sm:w-auto">
                <button id="mainTabCreate"
                    onclick="
                /* 1. إظهار وإخفاء الأقسام */
                document
                  .getElementById('createSection')
                  .classList.remove('hidden');
                document.getElementById('trackSection').classList.add('hidden');

                /* 2. تفعيل شكل هذا الزر */
                this.classList.add(
                  'bg-white',
                  'dark:bg-slate-900',
                  'text-teal-600',
                  'shadow-sm',
                );
                this.classList.remove('text-gray-500');

                /* 3. إلغاء تفعيل الزر الآخر مباشرة */
                document
                  .getElementById('mainTabTrack')
                  .classList.remove(
                    'bg-white',
                    'dark:bg-slate-900',
                    'text-teal-600',
                    'shadow-sm',
                  );
                document
                  .getElementById('mainTabTrack')
                  .classList.add('text-gray-500');
              "
                    class="text-xs font-bold px-4 py-2 rounded-xl cursor-pointer bg-white dark:bg-slate-900 text-teal-600 shadow-sm ">
                    <i class="fa-solid fa-plus-circle ml-1"></i> إنشاء واجب جديد
                </button>

                <button id="mainTabTrack"
                    onclick="
                /* 1. إظهار وإخفاء الأقسام */
                document
                  .getElementById('trackSection')
                  .classList.remove('hidden');
                document
                  .getElementById('createSection')
                  .classList.add('hidden');

                /* 2. تفعيل شكل هذا الزر */
                this.classList.add(
                  'bg-white',
                  'dark:bg-slate-900',
                  'text-teal-600',
                  'shadow-sm',
                );
                this.classList.remove('text-gray-500');

                /* 3. إلغاء تفعيل الزر الآخر مباشرة */
                document
                  .getElementById('mainTabCreate')
                  .classList.remove(
                    'bg-white',
                    'dark:bg-slate-900',
                    'text-teal-600',
                    'shadow-sm',
                  );
                document
                  .getElementById('mainTabCreate')
                  .classList.add('text-gray-500');
              "
                    class="text-xs font-bold px-4 py-2 rounded-xl cursor-pointer text-gray-500 ">
                    <i class="fa-solid fa-graduation-cap ml-1"></i> تصحيح ومتابعة
                    الواجبات
                </button>
            </div>
        </div>

        <div id="createSection" class="space-y-6 block">
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
                <div
                    class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm space-y-4">
                    <h3
                        class="text-xs font-black text-slate-800 dark:text-zinc-200 flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                        <span class="w-1.5 h-3 bg-teal-600 rounded-full"></span> بيانات
                        الواجب الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">عنوان الواجب
                                الدراسي *</label>
                            <input type="text" required placeholder="مثال: واجب درس الفاعل والمفعول به - ملف PDF"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500" />
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">المادة والصف
                                المستهدف</label>
                            <select
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 cursor-pointer">
                                <option>اللغة العربية - الصف الأول الإعدادي</option>
                                <option>اللغة العربية - الصف الثاني الإعدادي</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">آخر موعد لتسليم
                                الطلاب *</label>
                            <input type="datetime-local" required
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 cursor-pointer" />
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm space-y-4">
                    <h3
                        class="text-xs font-black text-slate-800 dark:text-zinc-200 flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                        <span class="w-1.5 h-3 bg-teal-600 rounded-full"></span> تفاصيل
                        ومطلوبات الواجب
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">وصف الواجب أو
                                النص المطلوب</label>
                            <textarea rows="3" placeholder="اكتب تعليماتك للطلاب هنا..."
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">إرفاق ملف أسئلة
                                من المعلم (اختياري)</label>
                            <input type="file" accept=".pdf,image/*"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 focus:border-teal-500 cursor-pointer" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-zinc-300 mb-1.5">درجة الواجب الإجمالية *</label>
                        <input type="number" min="1" max="100" placeholder="أدخل الدرجة الإجمالية (مثال: 10)"
                            class="w-full border border-slate-800 focus:ring-2 focus:ring-teal-600 bg-slate-950 rounded-xl py-2.5 px-4 text-xs outline-none text-zinc-200" />
                    </div>
                </div>


                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-8 py-3 rounded-xl  shadow-lg shadow-teal-600/10 cursor-pointer">
                        نشر وتكليف الطلاب فوراً
                    </button>
                </div>
            </form>
        </div>

        <div id="trackSection" class="space-y-6 hidden">
            <div id="assignmentsListView"
                class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-3xl p-6 shadow-sm space-y-4 block">
                <h3
                    class="text-xs font-black text-slate-800 dark:text-zinc-200 flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                    <span class="w-1.5 h-3 bg-teal-600 rounded-full"></span> 1. اختر
                    الواجب المراد استعراض تسليمات طلابه
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse text-xs">
                        <thead>
                            <tr
                                class="border-b border-gray-100 dark:border-slate-800 text-gray-700 dark:text-gray-400 font-bold">
                                <th class="pb-3 pl-4">اسم الواجب الدراسي</th>
                                <th class="pb-3 px-4">الصف</th>
                                <th class="pb-3 px-4">إجمالي التسليمات</th>
                                <th class="pb-3 pr-4 text-left">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60">
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 ">
                                <td class="py-4 pl-4 font-medium text-slate-800 dark:text-zinc-200">
                                    واجب النحو: الفاعل والمفعول به
                                </td>
                                <td class="py-4 px-4 text-gray-400">الصف الأول الإعدادي</td>
                                <td class="py-4 px-4 text-teal-600 font-bold">
                                    2 طلاب قاموا بالرفع
                                </td>
                                <td class="py-4 pr-4 text-left">
                                    <button
                                        onclick="
                          document
                            .getElementById('assignmentsListView')
                            .classList.add('hidden');
                          document
                            .getElementById('studentsListView')
                            .classList.remove('hidden');
                        "
                                        type="button"
                                        class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-xl font-bold cursor-pointer  shadow-sm">
                                        عرض تسليمات الطلاب
                                        <i class="fa-solid fa-arrow-left mr-1 text-[10px]"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="studentsListView"
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-6 shadow-sm space-y-4 hidden">
                <div class="flex justify-between items-center pb-2 border-b border-gray-100 dark:border-slate-800">
                    <button
                        onclick="
                  document
                    .getElementById('studentsListView')
                    .classList.add('hidden');
                  document
                    .getElementById('assignmentsListView')
                    .classList.remove('hidden');
                "
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-200 font-bold cursor-pointer">
                        <i class="fa-solid fa-arrow-right"></i> عودة للواجبات
                    </button>
                    <span class="text-xs font-black text-slate-800 dark:text-zinc-100">ملفات تسليم الطلاب لـ:
                        <span class="text-teal-600">واجب النحو</span></span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse text-xs">
                        <thead>
                            <tr
                                class="border-b border-gray-100 dark:border-slate-800 text-gray-700 dark:text-gray-500 font-bold">
                                <th class="pb-3 pl-4">اسم الطالب</th>
                                <th class="pb-3 px-4">الملف المرفوع (PDF)</th>
                                <th class="pb-3 px-4">حالة التقييم</th>
                                <th class="pb-3 px-4">موعد تسليم الطالب</th>
                                <th class="pb-3 pr-4 text-left">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-slate-800/60">
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 ">
                                <td class="py-4 pl-4 font-bold text-slate-800 dark:text-zinc-100">
                                    أحمد محمد علي
                                </td>
                                <td class="py-4 px-4 text-teal-600 font-medium">
                                    <a href="#" target="_blank" class="hover:underline flex items-center gap-1"><i
                                            class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                                        homework_ahmed.pdf</a>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="text-rose-500 font-bold bg-rose-50 dark:bg-rose-950/30 px-2 py-0.5 rounded">لم
                                        يصحح</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="text-teal-600 font-bold   px-2 py-0.5 rounded">
                                        16/5/2026</span>
                                </td>
                                <td class="py-4 pr-4 text-left">
                                    <button
                                        onclick="
                          document
                            .getElementById('finalCorrectionModal')
                            .classList.remove('hidden')
                        "
                                        type="button"
                                        class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-zinc-200 hover:bg-teal-600 hover:text-white px-3 py-1.5 rounded-lg font-bold cursor-pointer ">
                                        فحص وتصحيح
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 ">
                                <td class="py-4 pl-4 font-bold text-slate-800 dark:text-zinc-100">
                                    سارة عبد الله
                                </td>
                                <td class="py-4 px-4 text-teal-600 font-medium">
                                    <a href="#" target="_blank" class="hover:underline flex items-center gap-1"><i
                                            class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                                        assignment_sara.pdf</a>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="text-rose-500 font-bold bg-rose-50 dark:bg-rose-950/30 px-2 py-0.5 rounded">لم
                                        يصحح</span>
                                </td>
                                <td class="py-4 px-4">
                                    <span
                                        class="text-rose-500 font-bold bg-rose-50 dark:bg-rose-950/30 px-2 py-0.5 rounded">
                                        متأخر</span>
                                </td>
                                <td class="py-4 pr-4 text-left">
                                    <button
                                        onclick="
                          document
                            .getElementById('finalCorrectionModal')
                            .classList.remove('hidden')
                        "
                                        type="button"
                                        class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-zinc-200 hover:bg-teal-600 hover:text-white px-3 py-1.5 rounded-lg font-bold cursor-pointer ">
                                        فحص وتصحيح
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="finalCorrectionModal" class="fixed inset-0 z-[999] overflow-y-auto hidden" dir="rtl">
        <div class="flex items-center justify-center min-h-screen p-4 text-center sm:block sm:p-0">
            <div onclick="
              document
                .getElementById('finalCorrectionModal')
                .classList.add('hidden')
            "
                class="fixed inset-0 bg-slate-950/70 backdrop-blur-sm "></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 rounded-3xl text-right overflow-hidden shadow-2xl transform  sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full text-xs relative z-50">
                <div
                    class="bg-gray-50 dark:bg-slate-950/60 px-6 py-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-teal-500 animate-pulse"></span>
                        <h3 class="text-xs font-black text-slate-800 dark:text-zinc-100">
                            لوحة مراجعة وتقييم إجابة الطالب
                        </h3>
                    </div>
                    <button
                        onclick="
                  document
                    .getElementById('finalCorrectionModal')
                    .classList.add('hidden')
                "
                        type="button" class="text-gray-400 hover:text-gray-600 dark:hover:text-zinc-200 cursor-pointer">
                        <i class="fa-solid fa-circle-xmark text-lg"></i>
                    </button>
                </div>

                <form action="#" method="POST" class="p-6 space-y-5">
                    <div class="space-y-2">
                        <h4 class="font-bold text-gray-700 dark:text-slate-400">
                            1. مستند حل الطالب المرفوع:
                        </h4>
                        <div
                            class="p-4 border border-gray-200 dark:border-slate-800 rounded-2xl bg-gray-50 dark:bg-slate-950 flex flex-col sm:flex-row justify-between items-center gap-3">
                            <span class="text-slate-800 dark:text-zinc-100 font-medium"><i
                                    class="fa-solid fa-file-pdf text-rose-500 text-base ml-1"></i>
                                إجابة الطالب المرفوعة (PDF)</span>
                            <a href="#" target="_blank"
                                class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl text-center ">فتح
                                وتدقيق ملف الطالب
                                <i class="fa-solid fa-external-link mr-1 text-[10px]"></i></a>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <h4 class="font-bold text-gray-700 dark:text-slate-400">
                            2. رصد التقييم والدرجة المستحقة:
                        </h4>
                        <div
                            class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-4 bg-teal-50/30 dark:bg-slate-950/40 rounded-2xl border border-teal-100/60 dark:border-slate-800">
                            <div>
                                <label class="block font-bold text-gray-600 dark:text-slate-400 mb-1">الدرجة
                                    النهائية *</label>
                                <div class="relative flex items-center">
                                    <input type="number" required min="0" max="10" placeholder="مثال: 9"
                                        class="w-full border bg-white dark:bg-slate-900 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 text-center font-bold outline-none focus:border-teal-500" />
                                    <span class="absolute left-3 font-bold text-gray-400">/ 10</span>
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block font-bold text-gray-600 dark:text-slate-400 mb-1">التقييم
                                    والملاحظات (تظهر للـطالب)</label>
                                <input type="text" placeholder="اكتب ملاحظتك التوجيهية للطالب هنا..."
                                    class="w-full border bg-white dark:bg-slate-900 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500" />
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-2 border-t border-gray-100 dark:border-slate-800">
                        <button
                            onclick="
                    document
                      .getElementById('finalCorrectionModal')
                      .classList.add('hidden')
                  "
                            type="button"
                            class="bg-gray-100 dark:bg-slate-800 text-gray-600 dark:text-zinc-300 font-bold px-5 py-2 rounded-xl cursor-pointer">
                            إلغاء
                        </button>
                        <button type="submit"
                            class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2 rounded-xl shadow-md cursor-pointer">
                            حفظ واعتماد التقييم
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
