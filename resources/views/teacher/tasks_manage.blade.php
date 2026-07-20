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
                <a href="{{ route('assignments.index') }}" id="mainTabCreate"
                    class="text-xs font-bold px-4 py-2 rounded-xl cursor-pointer bg-white dark:bg-slate-900 text-teal-600 shadow-sm ">
                    <i class="fa-solid fa-plus-circle ml-1"></i> إنشاء واجب جديد
                </a>

                <a href="{{ route('gradingassignments') }}"
                    class="text-xs font-bold px-4 py-2 rounded-xl cursor-pointer text-gray-500 ">
                    <i class="fa-solid fa-graduation-cap ml-1"></i> تصحيح ومتابعة
                    الواجبات
                </a>
            </div>
        </div>

        <div id="createSection" class="space-y-6 block">
            <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6 text-xs">
                @csrf
                <div
                    class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-emerald-400 dark:border-slate-800/80 p-6 rounded-3xl shadow-sm space-y-4">
                    <h3
                        class="text-xs font-black text-slate-800 dark:text-zinc-200 flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                        <span class="w-1.5 h-3 bg-teal-600 rounded-full"></span> بيانات
                        الواجب الأساسية
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">عنوان الواجب الدراسي
                            </label>
                            <input type="text" name="title" required
                                placeholder="مثال: واجب درس الفاعل والمفعول به - ملف PDF"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500" />
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">المادة والصف
                                المستهدف</label>
                            <select name="section_id"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 cursor-pointer">
                                <option value="">-- اختر المادة والصف والشعبة --</option>

                                @foreach ($currentTeacher->subjects as $subject)
                                    @foreach ($currentTeacher->grades->unique('id') as $grade)
                                        @if ($grade->sections->isNotEmpty())
                                            <!-- إذا كان الصف يحتوي على شعب -->
                                            @foreach ($grade->sections as $section)
                                                <option value="sub_{{ $subject->id }}_sec_{{ $section->id }}">
                                                    {{ $subject->name }} - {{ $grade->name }} - شعبة ({{ $section->name }})
                                                </option>
                                            @endforeach
                                        @else
                                            <!-- إذا كان الصف لا يحتوي على شعب -->
                                            <option value="sub_{{ $subject->id }}_grd_{{ $grade->id }}">
                                                {{ $subject->name }} - {{ $grade->name }} (لا توجد شعب)
                                            </option>
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">آخر موعد لتسليم الطلاب
                                *</label>
                            <input type="datetime-local" required name="due_date"
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
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">وصف الواجب أو النص
                                المطلوب</label>
                            <textarea rows="3" placeholder="اكتب تعليماتك للطلاب هنا..." name="description"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2.5 px-4 outline-none focus:border-teal-500 resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">إرفاق ملف أسئلة من المعلم
                                (اختياري)</label>
                            <input type="file" accept=".pdf,image/*" name="file"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 focus:border-teal-500 cursor-pointer" />
                        </div>
                        <div>
                            <label class="block font-bold text-gray-700 dark:text-slate-400 mb-1">درجة الواجب الاجمالية</label>
                            <input type="number"  name="total_mark"
                                class="w-full border border-gray-200 dark:border-slate-800 bg-gray-50 dark:bg-slate-950 text-slate-800 dark:text-zinc-100 rounded-xl py-2 px-4 focus:border-teal-500 cursor-pointer" />
                        </div>
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
    </div>
@endsection
