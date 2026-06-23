@extends('student.parent')
@section('title', 'المواد')
@section('content')

        <div class="w-full space-y-6 text-xs" dir="rtl">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <div id="student-card-arabic"
                    class="bg-white dark:bg-slate-900 border-2 border-teal-500 p-5 rounded-3xl shadow-xs flex flex-col justify-between space-y-4">
                    <div class="flex items-start justify-between gap-3">
                        <div class="space-y-1">
                            <span
                                class="bg-teal-50 dark:bg-teal-950 text-teal-600 text-[10px] font-black px-2 py-0.5 rounded">إلزامي</span>
                            <h4 class="font-black text-slate-800 dark:text-zinc-100 text-xs pt-1">
                                اللغة العربية والشرعية
                            </h4>
                            <p class="text-[10px] text-gray-400 font-medium">
                                المعلم المشرف: أ. أحمد محمد
                            </p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-2xl bg-teal-50 dark:bg-teal-950/40 flex items-center justify-center text-teal-600 shrink-0">
                            <i class="fa-solid fa-book-open text-base"></i>
                        </div>
                    </div>

                    <div
                        class="pt-3 border-t border-gray-100 dark:border-slate-800/60 flex items-center justify-between">
                        <span class="text-gray-400 font-bold"><i
                                class="fa-solid fa-circle-play ml-0.5 text-teal-600"></i> 2
                            محتوى تعليمي نشط</span>
                        <button
                            onclick="
                  viewStudentSubject('arabic', 'اللغة العربية والشرعية', this)
                "
                            class="stud-subject-btn bg-teal-600 text-white font-bold px-3 py-1.5 rounded-xl cursor-pointer shadow-xs flex items-center gap-1">
                            <span>مفتوح الآن</span>
                            <i class="fa-solid fa-folder-open text-[10px]"></i>
                        </button>
                    </div>
                </div>

                <div id="student-card-math"
                    class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 p-5 rounded-3xl shadow-xs flex flex-col justify-between space-y-4 hover:border-teal-500">
                    <div class="flex items-start justify-between gap-3">
                        <div class="space-y-1">
                            <span
                                class="bg-teal-50 dark:bg-teal-950 text-teal-600 text-[10px] font-black px-2 py-0.5 rounded">إلزامي</span>
                            <h4 class="font-black text-slate-800 dark:text-zinc-100 text-xs pt-1">
                                الرياضيات والجبر
                            </h4>
                            <p class="text-[10px] text-gray-400 font-medium">
                                المعلم المشرف: أ. محمود عبد الرحمن
                            </p>
                        </div>
                        <div
                            class="w-10 h-10 rounded-2xl bg-indigo-50 dark:bg-indigo-950/40 flex items-center justify-center text-indigo-600 shrink-0">
                            <i class="fa-solid fa-calculator text-base"></i>
                        </div>
                    </div>

                    <div
                        class="pt-3 border-t border-gray-100 dark:border-slate-800/60 flex items-center justify-between">
                        <span class="text-gray-400 font-bold"><i
                                class="fa-solid fa-circle-play ml-0.5 text-indigo-500"></i>
                            2 محتوى تعليمي نشط</span>
                        <button
                            class="stud-subject-btn bg-slate-800 dark:bg-slate-700 hover:bg-teal-600 text-white font-bold px-3 py-1.5 rounded-xl cursor-pointer shadow-xs flex items-center gap-1">
                            <span>عرض المحتوى</span>
                            <i class="fa-solid fa-chevron-left text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 rounded-3xl p-5 shadow-sm space-y-5">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-50 dark:border-slate-800">
                    <span class="w-1.5 h-3 bg-teal-600 rounded-full animate-pulse"></span>
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                        المحتوى والدروس المتاحة لمادة:
                        <span id="studSubjectTitle" class="text-teal-600">اللغة العربية والشرعية</span>
                    </h3>
                </div>

                <div id="stud-lessons-arabic" class="stud-content-block space-y-4 block">
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
                                        فيديو شرح: أحكام الفاعل والمفعول به بالتفصيل
                                    </h5>
                                </div>
                            </div>
                            <button
                                class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-3 py-1.5 rounded-xl shadow-2xs w-fit cursor-pointer">
                                <i class="fa-solid fa-play ml-1"></i> تشغيل المحاضرة
                            </button>
                        </div>
                    </div>

                    <div
                        class="p-4 border border-gray-100 dark:border-slate-800/60 bg-gray-50/20 dark:bg-slate-950/20 rounded-2xl">
                        <div
                            class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 w-full">
                            <div class="flex items-start gap-3 flex-1">
                                <div
                                    class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 dark:bg-rose-950/40 flex items-center justify-center text-sm shrink-0 mt-0.5">
                                    <i class="fa-solid fa-file-pdf text-base"></i>
                                </div>
                                <div class="space-y-1 min-w-0">
                                    <h5
                                        class="font-bold text-slate-800 dark:text-zinc-200 text-xs leading-normal break-words">
                                        ملخص الشرح PDF: كبسولة مراجعة الجملة الفعلية والأوزان
                                    </h5>
                                </div>
                            </div>

                            <div
                                class="flex items-center gap-2 shrink-0 w-full md:w-fit justify-end border-t md:border-t-0 pt-3 md:pt-0 border-gray-100 dark:border-slate-800">
                                <button
                                    onclick="
                      openClassroomPdf(
                        'https://raw.githubusercontent.com/mozilla/pdf.js/ba2edeae/web/compressed.tracemonkey-pldi-09.pdf',
                        'ملخص الشرح PDF: كبسولة مراجعة الجملة الفعلية',
                      )
                    "
                                    class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 font-bold px-3 py-1.5 rounded-xl text-slate-700 dark:text-zinc-300 hover:bg-gray-50 dark:hover:bg-slate-700 shadow-2xs text-center cursor-pointer flex items-center gap-1 text-[11px] whitespace-nowrap">
                                    <i class="fa-solid fa-eye text-teal-600"></i>
                                    <span>عرض الملف هنا</span>
                                </button>

                                <a href="#"
                                    onclick="
                      alert('جاري تحميل الملف...');
                      return false;
                    "
                                    class="bg-slate-800 dark:bg-teal-700 hover:bg-teal-600 dark:hover:bg-teal-600 font-bold px-3 py-1.5 rounded-xl text-white shadow-2xs text-center cursor-pointer flex items-center gap-1 text-[11px] whitespace-nowrap">
                                    <i class="fa-solid fa-download"></i>
                                    <span>تحميل</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div id="classroomPdfModal"
                        class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-xs items-center justify-center p-4 md:p-10"
                        dir="rtl">
                        <div
                            class="bg-white dark:bg-slate-900 w-full max-w-5xl h-[85vh] rounded-3xl shadow-2xl border border-gray-200 dark:border-slate-800 flex flex-col overflow-hidden animate-scale-up">
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
                                <iframe id="pdfFrameElement" src=""
                                    class="w-full h-full absolute inset-0 border-0"
                                    style="height: 100%; width: 100%"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
        <script>
        function viewStudentSubject(subjectId, subjectName, btnElement) {
            // 1. تحديث نص عنوان صندوق الدروس الحالي بالأسفل
            document.getElementById("studSubjectTitle").innerText = subjectName;

            // 2. إخفاء جميع كتل الدروس المفتوحة
            const blocks = document.querySelectorAll(".stud-content-block");
            blocks.forEach((b) => {
                b.classList.add("hidden");
                b.classList.remove("block");
            });

            // 3. إظهار دروس المادة المختارة
            const targetBlock = document.getElementById(
                "stud-lessons-" + subjectId,
            );
            if (targetBlock) {
                targetBlock.classList.remove("hidden");
                targetBlock.classList.add("block");
            }

            // 4. إعادة كروت المواد لشكلها غير النشط
            const cards = ["student-card-arabic", "student-card-math"];
            cards.forEach((c) => {
                let cardEl = document.getElementById(c);
                if (cardEl) {
                    cardEl.className =
                        "bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 p-5 rounded-3xl shadow-xs flex flex-col justify-between space-y-4 hover:border-teal-500 ";
                }
            });

            // 5. تمييز الكرت الحالي النشط بإطار ملون واضح
            const targetCard = document.getElementById("student-card-" + subjectId);
            if (targetCard) {
                targetCard.className =
                    "bg-white dark:bg-slate-900 border-2 border-teal-500 p-5 rounded-3xl shadow-xs flex flex-col justify-between space-y-4 ";
            }

            // 6. تصفير وإعادة تهيئة أزرار التصفح لتبدو طبيعية
            const buttons = document.querySelectorAll(".stud-subject-btn");
            buttons.forEach((btn) => {
                btn.className =
                    "stud-subject-btn bg-slate-800 dark:bg-slate-700 hover:bg-teal-600 text-white font-bold px-3 py-1.5 rounded-xl  cursor-pointer shadow-xs flex items-center gap-1";
                btn.innerHTML =
                    '<span>عرض المحتوى</span> <i class="fa-solid fa-chevron-left text-[10px]"></i>';
            });

            // تمييز الزر الحالي ليدل على الفتح النشط
            btnElement.className =
                "stud-subject-btn bg-teal-600 text-white font-bold px-3 py-1.5 rounded-xl  cursor-pointer shadow-xs flex items-center gap-1";
            btnElement.innerHTML =
                '<span>مفتوح الآن</span> <i class="fa-solid fa-folder-open text-[10px]"></i>';
        }
    </script>
    <script>
        function openClassroomPdf(fileUrl, fileTitle) {
            document.getElementById("modalFileTitle").innerText = fileTitle;

            // استخدام قارئ مستندات أوفيس/جوجل الرسمي والمستقر جداً للمعاينة الحية بدون تحميل
            const viewerUrl =
                "https://docs.google.com/gview?url=" +
                encodeURIComponent(fileUrl) +
                "&embedded=true";

            const frame = document.getElementById("pdfFrameElement");
            frame.src = viewerUrl;

            // إظهار المودال بالكامل
            const modal = document.getElementById("classroomPdfModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closePdfViewer() {
            const modal = document.getElementById("classroomPdfModal");
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            document.getElementById("pdfFrameElement").src = "";
        }
    </script>
@endsection
