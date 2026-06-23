@extends('teacher.parent')
@section('title', 'الدروس')
@section('content')
    <div class="w-full space-y-6 my-6 text-xs" dir="rtl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-5 rounded-3xl shadow-xs space-y-4">
                <div class="pb-2 border-b border-gray-50 dark:border-slate-800">
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs flex items-center gap-1.5">
                        <i class="fa-solid fa-cloud-arrow-up text-teal-600"></i> نشر درس
                        جديد
                    </h3>
                    <p class="text-[11px] text-slate-700 dark:text-gray-400 font-medium">
                        امْلأ البيانات لبث المحتوى لحسابات الطلاب
                    </p>
                </div>

                <form class="space-y-3.5">
                    <div class="space-y-1">
                        <label class="font-bold text-slate-700 dark:text-zinc-300 block">المادة المستهدفة:</label>
                        <select required
                            class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-200 rounded-xl p-2.5 outline-none font-medium cursor-pointer">
                            <option value="">اختر المادة...</option>
                            <option>اللغة العربية والشرعية</option>
                            <option>الرياضيات والجبر</option>
                            <option>مادة البلاغة والنصوص</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">الشعبة
                            الدراسية:</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label
                                class="border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 rounded-xl p-2 flex items-center gap-1.5 cursor-pointer bg-gray-50/30 dark:bg-slate-950/20 hover:border-teal-500">
                                <input type="checkbox" checked class="accent-teal-600 rounded" />
                                <span class="font-bold text-[10px] text-slate-700 dark:text-zinc-300">شعبة
                                    (أ)</span>
                            </label>
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex items-center gap-1.5 cursor-pointer bg-gray-50/30 dark:bg-slate-950/20 hover:border-teal-500">
                                <input type="checkbox" class="accent-teal-600 rounded" />
                                <span class="font-bold text-[10px] text-slate-700 dark:text-zinc-300">شعبة
                                    (ب)</span>
                            </label>
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex items-center gap-1.5 cursor-pointer bg-gray-50/30 dark:bg-slate-950/20 hover:border-teal-500">
                                <input type="checkbox" class="accent-teal-600 rounded" />
                                <span class="font-bold text-[10px] text-slate-700 dark:text-zinc-300">شعبة
                                    (ج)</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">عنوان
                            المحاضرة:</label>
                        <input type="text" required placeholder="مثال: شرح درس المفاعيل الخمسة"
                            class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 focus:outline-none focus:ring-2 focus:ring-teal-600 text-slate-800 dark:text-zinc-200 rounded-xl p-2.5 outline-none font-medium placeholder-gray-400" />
                    </div>

                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">نوع الملف:</label>
                        <div class="grid grid-cols-3 gap-2">
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex flex-col items-center justify-center gap-1 cursor-pointer hover:border-teal-500">
                                <input type="radio" name="teacherType" checked class="accent-teal-600" />
                                <i class="fa-solid fa-video text-amber-500 text-xs"></i>
                                <span class="font-bold text-[10px]">فيديو شرح</span>
                            </label>
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex flex-col items-center justify-center gap-1 cursor-pointer hover:border-teal-500">
                                <input type="radio" name="teacherType" class="accent-teal-600" />
                                <i class="fa-solid fa-file-pdf text-rose-500 text-xs"></i>
                                <span class="font-bold text-[10px]">ملف PDF</span>
                            </label>
                            <label
                                class="border border-gray-200 dark:border-slate-800 rounded-xl p-2 flex flex-col items-center justify-center gap-1 cursor-pointer hover:border-teal-500">
                                <input type="radio" name="teacherType" class="accent-teal-600" />
                                <i class="fa-solid fa-bezier-curve text-indigo-500 text-xs"></i>
                                <span class="font-bold text-[10px]">مرفق خارجي</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-1">
                        <label class="font-bold mt-3 text-slate-700 dark:text-zinc-300 block">ملف الشرح
                            المرفق:</label>
                        <div onclick="document.getElementById('uploadFileMain').click()"
                            class="bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 rounded-2xl p-4 text-center cursor-pointer">
                            <i class="fa-solid fa-cloud-arrow-up text-teal-600 text-base mb-1 animate-pulse"></i>
                            <p class="font-bold text-slate-700 dark:text-zinc-300">
                                اسحب الملف هنا أو اضغط للتصفح
                            </p>
                            <p class="text-[9px] text-gray-400 mt-0.5">
                                الحد الأقصى للمحاضرة 60MB
                            </p>
                            <input type="file" id="uploadFileMain" class="hidden" />
                        </div>
                    </div>

                    <button type="submit"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white shadow-md shadow-teal-700/10 font-black mt-4 py-2.5 rounded-xl cursor-pointer text-center">
                        <i class="fa-solid fa-share-nodes ml-1"></i> بث ونشر المحاضرة
                        للطلاب
                    </button>
                </form>
            </div>

            <div
                class="lg:col-span-2 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 dark:border-slate-800 p-5 rounded-3xl shadow-xs flex flex-col space-y-4">
                <div class="pb-2 border-b border-gray-50 dark:border-slate-800">
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                        📂 أرشيف الدروس المنشورة تحت إشرافك
                    </h3>
                    <p class="text-[11px] text-slate-700 dark:text-gray-400 font-medium">
                        متابعة حجم التحميلات والمشاهدات لكل درس تعليمي مرفوع
                    </p>
                </div>

                <div class="space-y-3 flex-1 overflow-y-auto max-h-[440px] pl-1">
                    <div
                        class="p-3.5 border border-gray-100 dark:border-slate-800/60 bg-gray-50/10 dark:bg-slate-950/20 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/40 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-video"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                    فيديو شرح: أحكام الفاعل والمفعول به بالتفصيل
                                </h4>
                                <p class="text-[10px] text-gray-400">
                                    المادة:
                                    <span class="text-teal-600 font-bold">اللغة العربية</span>
                                    • الشُعب:
                                    <span class="font-medium text-slate-600 dark:text-zinc-300">شعبة (أ)، شعبة
                                        (ب)</span>
                                </p>
                                <div class="flex items-center gap-3 pt-1 text-[9px] text-gray-400 font-bold">
                                    <span><i class="fa-solid fa-eye text-teal-600"></i> 42
                                        مشاهدة</span>
                                </div>
                            </div>
                        </div>
                        <button
                            onclick="
                    this.closest('.p-3.5').remove();
                    alert('تم حذف وإلغاء نشر الدرس الدراسي الحاضر.');
                  "
                            class="bg-white dark:bg-slate-800 text-rose-500 border border-gray-200 dark:border-slate-700 font-bold px-2.5 py-1.5 rounded-xl hover:bg-rose-50 cursor-pointer text-[10px] shrink-0 w-fit">
                            <i class="fa-solid fa-trash-can"></i> حذف المحاضرة
                        </button>
                    </div>

                    <div
                        class="p-3.5 border border-gray-100 dark:border-slate-800/60 bg-gray-50/10 dark:bg-slate-950/20 rounded-2xl flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-rose-50 text-rose-500 dark:bg-rose-955 flex items-center justify-center text-sm shrink-0">
                                <i class="fa-solid fa-file-pdf"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 dark:text-zinc-200">
                                    ملخص الشرح PDF: كبسولة مراجعة الجملة الفعلية والأوزان
                                </h4>
                                <p class="text-[10px] text-gray-400">
                                    المادة:
                                    <span class="text-teal-600 font-bold">اللغة العربية</span>
                                    • الشُعب:
                                    <span class="font-medium text-slate-600 dark:text-zinc-300">شعبة (أ) فقط</span>
                                </p>
                                <div class="flex items-center gap-3 pt-1 text-[9px] text-gray-400 font-bold">
                                    <span><i class="fa-solid fa-download text-indigo-500"></i> 31
                                        تحميلاً</span>
                                </div>
                            </div>
                        </div>
                        <button onclick="alert('حذف الملف...')"
                            class="bg-white dark:bg-slate-800 text-rose-500 border border-gray-200 dark:border-slate-700 font-bold px-2.5 py-1.5 rounded-xl hover:bg-rose-50 cursor-pointer text-[10px] shrink-0 w-fit">
                            <i class="fa-solid fa-trash-can"></i> حذف المحاضرة
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
