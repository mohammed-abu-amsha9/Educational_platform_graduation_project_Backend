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

                <div id="assignment-card-1"
                    class="bg-white dark:bg-slate-900 border border-gray-100 hover:border-teal-400 dark:border-slate-800/80 p-5 rounded-3xl shadow-sm hover:shadow-xl space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3">
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="bg-indigo-50 dark:bg-indigo-950 text-indigo-600 text-[10px] font-black px-2.5 py-0.5 rounded-lg">اللغة العربية والشرعية</span>
                                <span id="badge-status-1"
                                    class="bg-amber-50 dark:bg-amber-950/60 text-amber-600 text-[10px] font-bold px-2 py-0.5 rounded-lg flex items-center gap-1">
                                    <i class="fa-solid fa-hourglass-half text-[9px]"></i>
                                    متبقي 3 أيام
                                </span>
                            </div>
                            <h5 class="font-black text-slate-800 dark:text-zinc-100 text-xs">
                                واجب: إعراب الجملة الفعلية والأفعال الخمسة
                            </h5>
                            <p class="text-gray-400 font-medium text-[11px] leading-relaxed">
                                توصيف المهمة: قم بحل التمارين الموجودة في الصفحة 42 من كتاب الأنشطة، وصوّر الحل بصيغة PDF واضحة ثم ارفعه هنا لتدقيق المعلم وتصحيحه.
                            </p>
                        </div>
                        <div class="bg-slate-50 dark:bg-slate-950 p-2.5 rounded-2xl border border-gray-100 dark:border-slate-800 text-center shrink-0 min-w-[100px]">
                            <p class="text-gray-400 text-[9px] font-bold">آخر موعد للتسليم</p>
                            <p class="font-black text-rose-500 text-[11px] mt-0.5">23 يونيو، 11:59 م</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-3 border-t border-dashed border-gray-100 dark:border-slate-800">
                        <span class="text-gray-400 font-medium text-[10px]"><i class="fa-solid fa-award text-indigo-600 ml-0.5"></i> الوزن: 10 درجات</span>
                        <button id="submit-btn-1"
                            onclick="openSubmitModal('واجب: إعراب الجملة الفعلية والأفعال الخمسة', 'assignment-card-1', 'badge-status-1', 'submit-btn-1')"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-black px-4 py-2 rounded-xl shadow-3xs cursor-pointer">
                            إرفاق وتسليم الواجب
                            <i class="fa-solid fa-upload mr-1 text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="space-y-3">
                    <h4 class="font-black text-emerald-600 dark:text-emerald-500 px-1 flex items-center gap-1">
                        <span>✓ سجل التسليمات والتصحيح</span>
                    </h4>
                    <div id="submissionHistoryLog" class="space-y-3">
                        <div class="text-center p-6 bg-gray-50/50 dark:bg-slate-900/40 border border-dashed border-gray-200 dark:border-slate-800 rounded-3xl text-gray-700 dark:text-gray-400 text-[13px]">
                            لم تقم بتسليم أي واجب في هذه الجلسة بعد.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="submitAssignmentModal" class="fixed inset-0 z-50 hidden bg-slate-900/80 backdrop-blur-xs items-center justify-center p-4" dir="rtl">
        <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-3xl shadow-2xl border border-emerald-400 flex flex-col overflow-hidden animate-scale-up">
            <div class="p-4 border-b border-gray-100 dark:border-slate-800 flex items-center justify-between bg-gray-50/50 dark:bg-slate-950/40">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-indigo-50 text-indigo-600 dark:bg-indigo-950/50 rounded-lg flex items-center justify-center text-xs">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </div>
                    <div>
                        <h4 class="font-black text-slate-800 dark:text-zinc-100 text-xs">إرسال ملفات الواجب الدراسي</h4>
                        <p id="targetAssignmentTitle" class="text-[10px] text-gray-400 font-medium truncate max-w-[280px] mt-0.5">اسم الواجب المختار</p>
                    </div>
                </div>
                <button onclick="closeSubmitModal()" class="bg-gray-200 dark:bg-slate-800 hover:bg-rose-500 hover:text-white dark:hover:bg-rose-600 text-slate-700 dark:text-zinc-300 w-6 h-6 rounded-lg flex items-center justify-center font-bold cursor-pointer">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>

            <div class="p-5 space-y-4">
                <div class="border-2 border-dashed border-gray-200 dark:border-slate-800 hover:border-indigo-500/50 rounded-2xl p-6 text-center cursor-pointer relative bg-gray-50/30 dark:bg-slate-950/10">
                    <input type="file" id="assignmentFileInput" onchange="handleFileSelection()" class="absolute inset-0 opacity-0 w-full h-full cursor-pointer" />

                    <div id="uploadPromptZone" class="space-y-2">
                        <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 rounded-full flex items-center justify-center text-base mx-auto">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <p class="font-bold text-slate-700 dark:text-zinc-200 text-xs">اضغط هنا للاختيار أو اسحب ملف الواجب</p>
                        <p class="text-[9px] text-gray-400 font-medium">يدعم صيغ (PDF, JPG, PNG) بحد أقصى 10MB</p>
                    </div>

                    <div id="fileSelectedZone" class="hidden space-y-1">
                        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-950 text-emerald-500 rounded-full flex items-center justify-center text-lg mx-auto animate-bounce">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        <p id="selectedFileName" class="font-black text-emerald-600 text-xs truncate max-w-xs mx-auto">file_name.pdf</p>
                        <p class="text-[9px] text-gray-400">جاهز للتسليم، اضغط لتغييره</p>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="font-bold text-slate-700 dark:text-zinc-300 text-[10px]">💬 إضافة ملاحظة أو سؤال للأستاذ (اختياري):</label>
                    <textarea id="studentSubmissionComment" rows="3" placeholder="اكتب هنا أي تفاصيل تود إطلاع معلم المادة عليها..." class="w-full bg-white dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-slate-800 dark:text-zinc-200 rounded-xl p-2.5 outline-none font-medium text-xs placeholder-gray-400 resize-none"></textarea>
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

            <div class="p-4 bg-gray-50 dark:bg-slate-950/40 border-t border-gray-100 dark:border-slate-800 flex items-center justify-end gap-2">
                <button onclick="closeSubmitModal()" class="bg-white dark:bg-slate-800 border border-gray-200 dark:border-slate-700 text-slate-700 dark:text-zinc-300 font-bold px-4 py-2 rounded-xl hover:bg-gray-50 cursor-pointer">إلغاء</button>
                <button id="confirmUploadBtn" onclick="executeFakeUpload()" disabled class="bg-indigo-600 disabled:opacity-40 hover:bg-indigo-700 text-white font-black px-5 py-2 rounded-xl shadow-xs cursor-pointer">
                    تأكيد تسليم الواجب <i class="fa-solid fa-paper-plane mr-1 text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="toast-container" class="fixed bottom-5 left-5 z-50 flex flex-col gap-2"></div>

@endsection

@section('scripts')
    <script>
        let isConnected = true; // تهيئة الحالة الافتراضية للاتصال لضمان نجاح الرفع
        let currentTargetCardId = "";
        let currentTargetBadgeId = "";
        let currentTargetBtnId = "";

        function openSubmitModal(assignmentTitle, cardId, badgeId, btnId) {
            currentTargetCardId = cardId;
            currentTargetBadgeId = badgeId;
            currentTargetBtnId = btnId;

            const titleEl = document.getElementById("targetAssignmentTitle");
            if (titleEl) titleEl.innerText = assignmentTitle;

            document.getElementById("assignmentFileInput").value = "";
            document.getElementById("studentSubmissionComment").value = "";
            document.getElementById("uploadPromptZone").classList.remove("hidden");
            document.getElementById("fileSelectedZone").classList.add("hidden");
            document.getElementById("uploadLoaderBar").classList.add("hidden");
            document.getElementById("confirmUploadBtn").disabled = true;

            const modal = document.getElementById("submitAssignmentModal");
            if (modal) {
                modal.classList.remove("hidden");
                modal.classList.add("flex");
            }
        }

        function closeSubmitModal() {
            const modal = document.getElementById("submitAssignmentModal");
            if (modal) {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
            }
        }

        function handleFileSelection() {
            const fileInput = document.getElementById("assignmentFileInput");
            const uploadPromptZone = document.getElementById("uploadPromptZone");
            const fileSelectedZone = document.getElementById("fileSelectedZone");
            const selectedFileName = document.getElementById("selectedFileName");
            const confirmUploadBtn = document.getElementById("confirmUploadBtn");

            if (fileInput.files.length > 0) {
                selectedFileName.innerText = fileInput.files[0].name;
                uploadPromptZone.classList.add("hidden");
                fileSelectedZone.classList.remove("hidden");
                confirmUploadBtn.disabled = false;
            }
        }

        function executeFakeUpload() {
            const loaderBar = document.getElementById("uploadLoaderBar");
            const percentText = document.getElementById("uploadPercentText");
            const barFill = document.getElementById("uploadProgressBarFill");
            const confirmBtn = document.getElementById("confirmUploadBtn");

            confirmBtn.disabled = true;
            loaderBar.classList.remove("hidden");

            let progress = 0;
            const interval = setInterval(() => {
                progress += 25;
                percentText.innerText = `${progress}%`;
                barFill.style.width = `${progress}%`;

                if (progress >= 100) {
                    clearInterval(interval);
                    finalizeAssignmentSubmission();
                }
            }, 300);
        }

        function finalizeAssignmentSubmission() {
            closeSubmitModal();
            showToast("تم رفع ملفات الواجب وتسليمها للمدرس بنجاح!", "success");

            const badge = document.getElementById(currentTargetBadgeId);
            if (badge) {
                badge.className = "bg-emerald-50 dark:bg-emerald-950 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-lg flex items-center gap-1";
                badge.innerHTML = `<i class="fa-solid fa-circle-check text-[9px]"></i> تم التسليم`;
            }

            const btn = document.getElementById(currentTargetBtnId);
            if (btn) {
                btn.disabled = true;
                btn.className = "bg-gray-100 dark:bg-slate-800 text-gray-400 dark:text-zinc-500 font-black px-4 py-2 rounded-xl cursor-not-allowed text-xs";
                btn.innerHTML = `تم تسليم الواجب بنجاح <i class="fa-solid fa-check mr-1 text-[10px]"></i>`;
            }

            const historyLog = document.getElementById("submissionHistoryLog");
            const titleText = document.getElementById("targetAssignmentTitle").innerText;

            if (historyLog) {
                const newLog = document.createElement("div");
                newLog.className = "p-4 bg-white dark:bg-slate-900 border border-emerald-100 dark:border-emerald-950/40 rounded-2xl space-y-2 shadow-3xs border-r-[4px] border-r-emerald-500 animate-scale-up text-right";
                newLog.innerHTML = `
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-slate-800 dark:text-zinc-200 text-[11px] truncate max-w-[180px]">${titleText}</span>
                        <span class="bg-amber-50 dark:bg-amber-950/40 text-amber-600 text-[9px] px-2 py-0.5 rounded font-bold">⏳ بانتظار التصحيح</span>
                    </div>
                    <p class="text-gray-400 text-[10px]">تاريخ التسليم: اليوم، منذ قليل</p>
                `;

                if (historyLog.innerHTML.includes("لم تقم بتسليم")) {
                    historyLog.innerHTML = "";
                }
                historyLog.appendChild(newLog);
            }
        }

        function showToast(message, type = "success") {
            const container = document.getElementById("toast-container");
            if (!container) return;

            const toast = document.createElement("div");
            toast.className = `p-4 rounded-xl text-xs font-bold text-white shadow-lg transform transition-all duration-300 flex items-center gap-2 ${
                type === "success" ? "bg-emerald-600" : type === "error" ? "bg-rose-600" : "bg-amber-500"
            }`;

            const icon = type === "success" ? "fa-circle-check" : type === "error" ? "fa-circle-xmark" : "fa-triangle-exclamation";
            toast.innerHTML = `<i class="fa-solid ${icon}"></i> <span>${message}</span>`;

            container.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3500);
        }
    </script>
@endsection
