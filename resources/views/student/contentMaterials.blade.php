@extends('student.parent')
@section('title', 'محتوى المادة')
@section('content')

    <div class="w-full space-y-6 text-xs" dir="rtl">
        <div
            class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-5 shadow-sm space-y-5">

            <!-- عنوان الكتلة لعرض اسم المادة الحالي -->
            <div class="flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                <span class="w-1.5 h-3 bg-teal-600 rounded-full animate-pulse"></span>
                <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                    المحتوى والدروس المتاحة لمادة:
                    <span id="studSubjectTitle" class="text-teal-600">{{ $subject->name }}</span>
                </h3>
            </div>

            <div id="stud-lessons-list" class="stud-content-block space-y-4 block">
                @forelse ($lessons as $lesson)
                    <!-- 1. إذا كان الدرس عبارة عن فيديو أو يحتوي على رابط فيديو -->
                    @if ($lesson->file_type == 'video')
                        <div
                            class="p-4 border border-gray-100 dark:border-slate-800/60 bg-gray-50/20 dark:bg-slate-950/20 rounded-2xl space-y-3">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-950/40 flex items-center justify-center text-sm shrink-0">
                                        <i class="fa-solid fa-video"></i>
                                    </div>
                                    <div>
                                        <h5 class="font-bold text-slate-800 dark:text-zinc-200">
                                            {{ 'فيديو شرح: ' . $lesson->title }}
                                        </h5>
                                    </div>
                                </div>

                                <a href="{{ asset('storage/' . $lesson->file_url) }}" target="_blank"
                                    class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-3 py-1.5 rounded-xl shadow-2xs w-fit cursor-pointer flex items-center gap-1 text-[11px]">
                                    <i class="fa-solid fa-play ml-1"></i> تشغيل المحاضرة
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- 2. إذا كان الدرس يحتوي على ملف PDF أو مرفقات -->
                    @if ($lesson->file_type == 'pdf')
                        <div
                            class="p-4 border border-gray-100 dark:border-slate-800/60 bg-gray-50/20 dark:bg-slate-950/20 rounded-2xl">
                            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 w-full">
                                <div class="flex items-start gap-3 flex-1">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 dark:bg-rose-950/40 flex items-center justify-center text-sm shrink-0 mt-0.5">
                                        <i class="fa-solid fa-file-pdf text-base"></i>
                                    </div>
                                    <div class="space-y-1 min-w-0">
                                        <h5
                                            class="font-bold text-slate-800 dark:text-zinc-200 text-xs leading-normal break-words">
                                            {{ 'ملخص الشرح PDF: ' . $lesson->title }}
                                        </h5>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-2 shrink-0 w-full md:w-fit justify-end border-t md:border-t-0 pt-3 md:pt-0 border-gray-100 dark:border-slate-800">
                                    <!-- زر معاينة الـ PDF داخل المودال عبر جافاسكريبت -->
                                    <button
                                        onclick="openClassroomPdf('{{ asset('storage/' . $lesson->file_url) }}', '{{ $lesson->title }}')"
                                        class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 font-bold px-3 py-1.5 rounded-xl text-slate-700 dark:text-zinc-300 hover:bg-gray-50 dark:hover:bg-slate-700 shadow-2xs text-center cursor-pointer flex items-center gap-1 text-[11px] whitespace-nowrap">
                                        <i class="fa-solid fa-eye text-teal-600"></i>
                                        <span>عرض الملف هنا</span>
                                    </button>

                                    <!-- زر تحميل الملف المباشر -->
                                    <a href="{{ asset('storage/' . $lesson->file_url) }}" download
                                        class="bg-slate-800 dark:bg-teal-700 hover:bg-teal-600 dark:hover:bg-teal-600 font-bold px-3 py-1.5 rounded-xl text-white shadow-2xs text-center cursor-pointer flex items-center gap-1 text-[11px] whitespace-nowrap">
                                        <i class="fa-solid fa-download"></i>
                                        <span>تحميل</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                @empty
                    <!-- رسالة منسقة في حال كانت المادة فارغة تماماً ولا تحتوي على دروس حالياً -->
                    <div
                        class="text-center py-12 bg-gray-50/50 dark:bg-slate-950/40 rounded-3xl border border-dashed border-gray-200 dark:border-slate-800">
                        <div
                            class="w-12 h-12 bg-teal-50 dark:bg-teal-950/30 text-teal-600 rounded-full flex items-center justify-center mx-auto mb-3">
                            <i class="fa-solid fa-folder-open text-lg"></i>
                        </div>
                        <h4 class="font-bold text-slate-700 dark:text-zinc-300 text-sm">لا يوجد محتوى تعليمي حالياً</h4>
                        <p class="text-gray-400 text-[11px] mt-1">المعلم لم يقم بنشر أي دروس في هذه المادة بعد.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- المودال الخاص بمعاينة الـ PDF (يُوضع خارج حاوية الحلقات ليعمل بشكل صحيح) -->
        <div id="classroomPdfModal"
            class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-xs items-center justify-center p-4 md:p-10"
            dir="rtl">
            <div
                class="bg-white dark:bg-slate-900 w-full max-w-5xl h-[85vh] rounded-3xl shadow-2xl border border-gray-200 dark:border-slate-800 flex flex-col overflow-hidden">
                <div
                    class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/50 dark:bg-slate-950/40 shrink-0">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-file-pdf text-rose-500 text-sm"></i>
                        <h4 id="modalFileTitle"
                            class="font-black text-slate-800 dark:text-zinc-100 text-xs truncate max-w-md">
                            معاينة الملف التعليمي
                        </h4>
                    </div>
                    <button onclick="closePdfViewer()"
                        class="bg-gray-200 dark:bg-slate-800 hover:bg-rose-500 hover:text-white dark:hover:bg-rose-600 text-slate-700 dark:text-zinc-300 w-7 h-7 rounded-xl flex items-center justify-center font-bold cursor-pointer shrink-0">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>

                <div class="flex-1 bg-slate-100 dark:bg-slate-950 w-full h-full min-h-0 relative">
                    <iframe id="pdfFrameElement" src="" class="w-full h-full absolute inset-0 border-0"
                        style="height: 100%; width: 100%"></iframe>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <!-- سكربت الـ JavaScript لتشغيل وإغلاق معاينة الـ PDF ديناميكياً -->
    <script>
        function openClassroomPdf(pdfUrl, title) {
            document.getElementById('modalFileTitle').innerText = title;
            document.getElementById('pdfFrameElement').src = pdfUrl;

            const modal = document.getElementById('classroomPdfModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closePdfViewer() {
            const modal = document.getElementById('classroomPdfModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.getElementById('pdfFrameElement').src = ''; // تنظيف الرابط عند الإغلاق
        }
    </script>
@endsection
