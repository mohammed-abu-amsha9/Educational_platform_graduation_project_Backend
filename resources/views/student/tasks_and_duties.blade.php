@extends('student.parent')
@section('title', 'المهام والواجبات')
@section('content')

    <div class="w-full space-y-6 text-xs text-right" dir="rtl">
        <div class="flex items-center justify-between pb-2 border-b border-gray-100 dark:border-slate-800">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-3 bg-indigo-600 rounded-full animate-pulse"></span>
                <h3 class="font-black text-slate-800 dark:text-zinc-100 text-sm">
                    📚 المهام والواجبات الدراسية
                </h3>
            </div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2 space-y-4">
                <h4 class="font-black text-slate-800 dark:text-zinc-200 px-1 flex items-center gap-1.5">
                    <span>⏳ واجبات قادمة ومطلوبة</span>
                </h4>
                @foreach ($assignments as $assignment)
                    <div id="assignment-card-1"
                        class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-teal-400 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm hover:shadow-xl space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                            <div class="space-y-1.5">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span
                                        class="bg-indigo-50 dark:bg-indigo-950 text-indigo-600 text-[10px] font-black px-2.5 py-0.5 rounded-lg">
                                        {{ $assignment->subject->name }}</span>
                                </div>
                                <h5 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                                    واجب: {{ $assignment->title }}
                                </h5>
                                <p class="text-gray-400 font-medium text-[11px] leading-relaxed">
                                    توصيف المهمة: {{ $assignment->description }}
                                </p>
                            </div>
                            <div
                                class="bg-slate-50 dark:bg-slate-950 p-2.5 rounded-2xl border border-gray-100 dark:border-slate-800 text-center shrink-0 min-w-[100px]">
                                <p class="text-gray-400 text-[9px] font-bold">آخر موعد للتسليم</p>
                                <p class="font-black text-rose-500 text-[11px] mt-0.5">
                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('d-m') }}
                                    - {{ \Carbon\Carbon::parse($assignment->due_date)->format('h:i A') }}</p>
                            </div>
                        </div>
                        <div
                            class="flex items-center justify-between pt-3 border-t border-dashed border-gray-100 dark:border-slate-800">
                            <span class="text-gray-400 font-medium text-[10px]"><i
                                    class="fa-solid fa-award text-indigo-600 ml-0.5"></i> العلامة:
                                {{ $assignment->total_mark }} درجات</span>
                            <button id="btn-{{ $assignment->id }}"
                                onclick="openSubmitModal('{{ $assignment->title }}', '{{ $assignment->id }}')"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-4 py-2 rounded-xl shadow-3xs cursor-pointer">
                                إرفاق وتسليم الواجب
                                <i class="fa-solid fa-upload mr-1 text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="grid grid-cols-2 gap-8">
                <!-- الجانب الأيمن: المهام المطلوبة التي لم يتم تسليمها -->
                <div class="space-y-4">
                    @foreach ($assignments as $assignment)
                        @if (!$mySubmissions->contains('assignment_id', $assignment->id))
                        @endif
                    @endforeach
                </div>

                <!-- الجانب الأيسر: سجل التسليمات (التصحيح) -->
                <div class="space-y-4 w-full">
                    @foreach ($mySubmissions as $submission)
                        <div class="p-4 border border-emerald-200 rounded-2xl flex justify-between items-center w-full">
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 dark:text-zinc-100">واجب: {{ $submission->assignment->title }}</h4>
                            </div>
                            <span class="text-amber-600 font-bold bg-amber-50 px-3 py-1 rounded-full text-xs">
                                تم التسليم
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <form id="submitAssignmentModal" action="{{ route('assignmentSubmissions.store') }}" method="POST"
        enctype="multipart/form-data"
        class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-xs items-center justify-center p-4" dir="rtl">
        @csrf
        <!-- حقل مخفي لتخزين ID الواجب الذي يتم تسليمه -->
        <input type="hidden" id="hiddenAssignmentId" name="assignment_id">
        <div
            class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-3xl shadow-2xl border border-emerald-400 flex flex-col overflow-hidden animate-scale-up">
            <div
                class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/50 dark:bg-slate-950/40">
                <div class="flex items-center gap-2">
                    <div
                        class="w-7 h-7 bg-indigo-50 text-indigo-600 dark:bg-indigo-950/50 rounded-lg flex items-center justify-center text-xs">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800 dark:text-zinc-100 text-xs">إرسال ملفات الواجب الدراسي</h4>
                        <p id="targetAssignmentTitle"
                            class="text-[10px] text-gray-400 font-medium truncate max-w-[280px] mt-0.5">
                        </p>
                    </div>
                </div>
                <button type="button" onclick="closeSubmitModal()"
                    class="bg-gray-200 dark:bg-slate-800 hover:bg-rose-500 hover:text-white dark:hover:bg-rose-600 text-slate-700 dark:text-zinc-300 w-6 h-6 rounded-lg flex items-center justify-center font-bold cursor-pointer">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            <div class="p-5 space-y-4">
                <div
                    class="border-2 border-dashed border-gray-200 dark:border-slate-800 hover:border-indigo-500/50 rounded-2xl p-6 text-center cursor-pointer relative bg-gray-50/30 dark:bg-slate-950/10">
                    <!-- تأكد أن الـ input هذا موجود داخل الـ form -->
                    <input type="file" name="file" id="assignmentFileInput" onchange="handleFileSelection()"
                        class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" />

                    <div id="uploadPromptZone" class="space-y-2">
                        <div
                            class="w-12 h-12 bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 rounded-full flex items-center justify-center text-base mx-auto">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <p class="font-bold text-slate-700 dark:text-zinc-200 text-xs">اضغط هنا للاختيار أو اسحب ملف الواجب
                        </p>
                        <p class="text-[9px] text-gray-400 font-medium">يدعم صيغ (PDF, JPG, PNG) بحد أقصى 10MB</p>
                    </div>

                    <div id="fileSelectedZone" class="hidden space-y-1">
                        <div
                            class="w-12 h-12 bg-emerald-50 dark:bg-emerald-950 text-emerald-500 rounded-full flex items-center justify-center text-lg mx-auto animate-bounce">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        <p id="selectedFileName" class="font-black text-emerald-600 text-xs truncate max-w-xs mx-auto">
                        </p>
                        <p class="text-[9px] text-gray-400">جاهز للتسليم، اضغط لتغييره</p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="font-bold text-slate-700 dark:text-zinc-300 text-[10px]">💬 إضافة ملاحظة أو سؤال للأستاذ
                        (اختياري):</label>
                    <textarea id="studentSubmissionComment" rows="3" placeholder="اكتب هنا أي تفاصيل تود إطلاع معلم المادة عليها..."
                        class="w-full bg-white dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-slate-800 dark:text-zinc-200 rounded-xl p-2.5 outline-none font-medium text-xs placeholder-gray-400 resize-none"></textarea>
                </div>

                <div id="uploadLoaderBar" class="hidden space-y-1.5 pt-1">
                    <div class="flex justify-between text-[9px] font-bold text-indigo-600">
                        <span>جاري رفع وتشفير الملفات...</span>
                        <span id="uploadPercentText">0%</span>
                    </div>
                    <div class="w-full bg-gray-100 dark:bg-slate-800 h-1.5 rounded-full overflow-hidden">
                        <div id="uploadProgressBarFill" class="bg-indigo-600 h-full" style="width: 0%"></div>
                    </div>
                </div>
            </div>

            <div
                class="p-4 bg-gray-50 dark:bg-slate-950/40 border-t border-gray-100 dark:border-slate-800 flex items-center justify-end gap-2">
                <button type="button" onclick="closeSubmitModal()"
                    class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-slate-700 dark:text-zinc-300 font-bold px-4 py-2 rounded-xl hover:bg-gray-50 cursor-pointer">إلغاء</button>
                <!-- احذف onclick="executeFakeUpload()" من هنا -->
                <button type="submit" id="confirmUploadBtn" disabled
                    class="bg-indigo-600 disabled:opacity-40 hover:bg-indigo-700 text-white font-black px-5 py-2 rounded-xl shadow-xs cursor-pointer">
                    تأكيد تسليم الواجب <i class="fa-solid fa-paper-plane mr-1 text-[10px]"></i>
                </button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        function openSubmitModal(title, id) {
            document.getElementById("targetAssignmentTitle").innerText = title;
            document.getElementById("hiddenAssignmentId").value = id; // تمرير الـ ID للـ form

            const modal = document.getElementById("submitAssignmentModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeSubmitModal() {
            document.getElementById("submitAssignmentModal").classList.add("hidden");
            document.getElementById("submitAssignmentModal").classList.remove("flex");
        }

        function handleFileSelection() {
            const fileInput = document.getElementById("assignmentFileInput");
            const file = fileInput.files[0]; // الملف الذي اختاره الطالب

            if (file) {
                // 1. تحديث الواجهة (كما كنت تفعل)
                document.getElementById("selectedFileName").innerText = file.name;
                document.getElementById("uploadPromptZone").classList.add("hidden");
                document.getElementById("fileSelectedZone").classList.remove("hidden");
                document.getElementById("confirmUploadBtn").disabled = false;

                // 2. تخزين الملف في ذاكرة مؤقتة (للاستخدام عند المزامنة)
                // سنقوم بإنشاء متغير عالمي مؤقت، أو يمكنك تخزين الـ Blob مباشرة في الـ IndexedDB
                window.tempSelectedFile = file;
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const submissionForm = document.getElementById("submitAssignmentModal");

            if (submissionForm) {
                submissionForm.addEventListener("submit", function(event) {
                    // إذا كان متصلاً، يرسل للسيرفر كالمعتاد
                    if (window.isOnline()) {
                        return;
                    }

                    // إذا كان أوفلاين: منع الإرسال
                    event.preventDefault();
                    event.stopPropagation();

                    const fileInput = document.getElementById('assignmentFileInput');
                    const file = fileInput.files[0];

                    // تحويل الملف لقراءة محتواه
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // حفظ البيانات + محتوى الملف الفعلي
                        const submissionData = {
                            assignment_id: document.getElementById('hiddenAssignmentId').value,
                            comment: document.getElementById('studentSubmissionComment').value,
                            file_name: file.name,
                            file_type: file.type,
                            file_content: e.target.result, // محتوى الملف (Blob/ArrayBuffer)
                            created_at: new Date().toISOString()
                        };

                        // حفظ في IndexedDB
                        window.saveActionLocally('SUBMIT_ASSIGNMENT', submissionData);

                        // إظهار رسالة
                        const toastContainer = document.getElementById('toast-container');
                        if (toastContainer) {
                            const toast = document.createElement('div');
                            toast.className =
                                "bg-rose-600 text-white px-6 py-3 rounded-2xl shadow-xl animate-fade-in";
                            toast.innerText =
                                "تم حفظ الواجب والملف محلياً، سيتم رفعهما عند عودة الاتصال.";
                            toastContainer.appendChild(toast);
                            setTimeout(() => toast.remove(), 3000);
                        }
                        closeSubmitModal();
                    };

                    // قراءة الملف كـ ArrayBuffer (مناسب جداً للتخزين)
                    reader.readAsArrayBuffer(file);
                });
            }
        });
    </script>
@endsection
