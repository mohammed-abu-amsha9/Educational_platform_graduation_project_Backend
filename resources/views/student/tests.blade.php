@extends('student.parent')
@section('title', 'الاختبارات')
@section('content')

        <div class="w-full space-y-6 text-xs text-right" dir="rtl" id="examsMainContainer">
            <div id="examsListView" class="space-y-6 block">
                <div class="flex items-center gap-2 pb-2 border-b border-gray-100 dark:border-slate-800">
                    <span class="w-1.5 h-3 bg-teal-600 rounded-full animate-pulse"></span>
                    <h3 class="font-black text-slate-800 dark:text-zinc-100 text-sm">
                        📝 منصة الاختبارات والتقييمات
                    </h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <h4 class="font-black text-slate-800 dark:text-zinc-200 px-2 flex items-center gap-1.5">
                            <span>📝 الاختبارات المتاحة</span>
                        </h4>

                        <div
                            class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 p-4 rounded-3xl shadow-sm hover:shadow-xl flex items-center justify-between gap-4 hover:border-teal-500/40">
                            <div class="space-y-2 flex-1 min-w-0">
                                <span
                                    class="bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-lg inline-flex items-center gap-1">
                                    <i class="fa-solid fa-cloud-arrow-up text-[8px]"></i> تمت
                                    المزامنة
                                </span>
                                <h5 class="font-black text-slate-800 dark:text-zinc-100 text-xs truncate">
                                    اختبار الرياضيات - الفصل الأول
                                </h5>
                                <div class="flex items-center gap-3 text-gray-400 text-[10px] font-medium flex-wrap">
                                    <span class="text-slate-500 dark:text-zinc-400 font-bold">الرياضيات</span>
                                    <span><i class="fa-solid fa-list-check ml-0.5 text-teal-600"></i>
                                        <span id="totalQuestionsCount">3</span> أسئلة</span>
                                    <span><i class="fa-solid fa-clock ml-0.5 text-amber-500"></i>
                                        10 دقائق</span>
                                </div>
                            </div>
                            <button onclick="startRealExamEngine()"
                                class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl cursor-pointer shadow-3xs shrink-0">
                                بدء الاختبار
                                <i class="fa-solid fa-chevron-left text-[9px] mr-1"></i>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <h4 class="font-black text-slate-800 dark:text-zinc-200 px-2">
                            📊 نتائج وتاريخ الاختبارات
                        </h4>
                        <div id="resultsLogContainer" class="space-y-3">
                            <div
                                class="bg-gray-50/50 dark:bg-slate-900/40 border border-dashed border-gray-200 dark:border-slate-800 p-8 rounded-3xl text-center text-gray-400">
                                لا توجد اختبارات مقدمة في الجلسة الحالية. اضغط بدء الاختبار
                                لتجربة المحاكي الواقعي.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="examActiveWorkspace" class="hidden grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
                <div
                    class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 p-4 rounded-3xl space-y-4 shadow-sm">
                    <div class="text-center pb-3 border-b border-gray-100 dark:border-slate-800">
                        <p class="text-gray-400 font-bold text-[10px] mb-1">
                            الوقت المتبقي
                        </p>
                        <div
                            class="bg-rose-50 dark:bg-rose-950/40 border border-rose-100 dark:border-rose-900/30 text-rose-600 text-sm font-black py-1.5 rounded-xl inline-flex items-center justify-center gap-1.5 px-4 w-full">
                            <i class="fa-solid fa-stopwatch animate-pulse"></i>
                            <span id="realTimerDisplay">10:00</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <p class="font-bold text-slate-700 dark:text-zinc-300 text-[10px]">
                            خريطة الأسئلة:
                        </p>
                        <div id="questionsMapTracker" class="grid grid-cols-3 gap-2"></div>
                    </div>

                    <div
                        class="pt-2 border-t border-gray-100 dark:border-slate-800 text-[10px] text-gray-400 leading-normal space-y-1">
                        <p>
                            💡 <span class="text-emerald-500 font-bold">الأخضر</span>: سؤال
                            تم الإجابة عليه.
                        </p>
                        <p>
                            💡 <span class="text-teal-600 font-bold">النيون</span>: السؤال
                            الحالي النشط.
                        </p>
                    </div>
                </div>

                <div
                    class="lg:col-span-3 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 p-6 rounded-3xl shadow-sm flex flex-col min-h-[400px] justify-between">
                    <div id="activeQuestionContainer" class="space-y-6"></div>

                    <div
                        class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-slate-800 mt-8">
                        <button id="prevQuestionBtn" onclick="navigateQuestion(-1)"
                            class="bg-gray-100 dark:bg-slate-800 text-slate-700 dark:text-zinc-300 font-bold px-4 py-2 rounded-xl disabled:opacity-40 disabled:cursor-not-allowed">
                            <i class="fa-solid fa-arrow-right ml-1"></i> السؤال السابق
                        </button>

                        <button id="nextQuestionBtn" onclick="navigateQuestion(1)"
                            class="bg-slate-800 dark:bg-slate-700 text-white font-bold px-4 py-2 rounded-xl">
                            السؤال التالي <i class="fa-solid fa-arrow-left mr-1"></i>
                        </button>

                        <button id="submitExamFinalBtn" onclick="finishAndCalculateScore()"
                            class="hidden bg-emerald-600 hover:bg-emerald-700 text-white font-black px-5 py-2 rounded-xl shadow-xs">
                            إنهاء وإرسال الإجابات
                            <i class="fa-solid fa-check-double mr-1 text-[10px]"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

@endsection
@section('scripts')
        <script>
        // بنك الأسئلة والمحاكي الفعلي للحل
        const mockQuestions = [{
                id: 1,
                text: "ما هو ناتج العملية الحسابية $5 \times 5 + 2$؟",
                options: {
                    a: "25",
                    b: "27",
                    c: "30",
                    d: "20"
                },
                correct: "b",
            },
            {
                id: 2,
                text: "المعادلة من الدرجة الأولى $x + 4 = 10$ تكون فيها قيمة $x$ مساوية لـ:",
                options: {
                    a: "4",
                    b: "5",
                    c: "6",
                    d: "14"
                },
                correct: "c",
            },
            {
                id: 3,
                text: "أي من القيم التالية تمثل حلاً للمخرجة الصفرية في الجبر الخطي؟",
                options: {
                    a: "المصفوفة الصفرية",
                    b: "المصفوفة الأحادية",
                    c: "المصفوفة القطرية",
                    d: "لا شيء مما سبق",
                },
                correct: "a",
            },
        ];

        let studentAnswers = {}; // لتخزين اختيارات الطالب الحية
        let currentQuestionIndex = 0;
        let examCountdown;

        function startRealExamEngine() {
            studentAnswers = {};
            currentQuestionIndex = 0;

            // إخفاء القوائم وإظهار مساحة الحل الواقعية
            document.getElementById("examsListView").className = "hidden";
            document.getElementById("examActiveWorkspace").className =
                "grid grid-cols-1 lg:grid-cols-4 gap-6 items-start";

            // تشغيل التايمر التنازلي الحقيقي لـ 10 دقائق
            let timeRemaining = 10 * 60;
            const timerDisplay = document.getElementById("realTimerDisplay");

            clearInterval(examCountdown);
            examCountdown = setInterval(() => {
                let mins = Math.floor(timeRemaining / 60);
                let secs = timeRemaining % 60;
                timerDisplay.innerText = `${mins}:${secs < 10 ? "0" + secs : secs}`;
                if (--timeRemaining < 0) {
                    clearInterval(examCountdown);
                    alert(
                        "انتهى الوقت المحدد للاختبار نظامياً! سيتم رصد الدرجة تلقائياً.",
                    );
                    finishAndCalculateScore();
                }
            }, 1000);

            renderActiveQuestion();
            renderTrackerMap();
        }

        function renderActiveQuestion() {
            const question = mockQuestions[currentQuestionIndex];
            const container = document.getElementById("activeQuestionContainer");

            // تحديث أزرار التنقل بناءً على مكان الطالب
            document.getElementById("prevQuestionBtn").disabled =
                currentQuestionIndex === 0;

            if (currentQuestionIndex === mockQuestions.length - 1) {
                document.getElementById("nextQuestionBtn").classList.add("hidden");
                document
                    .getElementById("submitExamFinalBtn")
                    .classList.remove("hidden");
            } else {
                document.getElementById("nextQuestionBtn").classList.remove("hidden");
                document.getElementById("submitExamFinalBtn").classList.add("hidden");
            }

            // بناء السؤال والخيارات مع تذكر خيار الطالب إذا عاد للخلف
            let optionsHtml = "";
            for (const [key, value] of Object.entries(question.options)) {
                const isChecked =
                    studentAnswers[question.id] === key ? "checked" : "";
                const selectedClass = isChecked ?
                    "border-teal-500 bg-teal-50/10 dark:bg-teal-950/20" :
                    "border-gray-200 dark:border-slate-800";

                optionsHtml += `
        <label onclick="saveAnswer(${question.id}, '${key}')" class="flex items-center gap-3 p-3.5 border ${selectedClass} rounded-2xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-800/50  font-bold text-slate-700 dark:text-zinc-300 text-xs">
          <input type="radio" name="activeQ" value="${key}" ${isChecked} class="w-4 h-4 accent-teal-600 shrink-0">
          <span>${key.toUpperCase()}) ${value}</span>
        </label>
      `;
            }

            container.innerHTML = `
      <div class="flex items-center justify-between gap-2 bg-slate-50 dark:bg-slate-950/40 p-3 rounded-2xl">
        <span class="text-teal-600 font-black text-[10px]">السؤال ${currentQuestionIndex + 1} من أصل ${mockQuestions.length}</span>
        <span class="text-gray-400 text-[10px]">الدرجة: 1.00</span>
      </div>
      <h4 class="font-black text-slate-800 dark:text-zinc-100 text-xs leading-relaxed">${question.text}</h4>
      <div class="grid grid-cols-1 gap-2.5 pt-2">${optionsHtml}</div>
    `;
        }

        function renderTrackerMap() {
            const mapContainer = document.getElementById("questionsMapTracker");
            mapContainer.innerHTML = "";

            mockQuestions.forEach((q, idx) => {
                let stateClass =
                    "bg-gray-100 dark:bg-slate-800 text-slate-600 dark:text-zinc-400"; // غير محلول
                if (studentAnswers[q.id]) {
                    stateClass = "bg-emerald-500 text-white font-bold"; // تم حله
                }
                if (currentQuestionIndex === idx) {
                    stateClass =
                        "ring-2 ring-teal-500 bg-teal-50 text-teal-600 dark:bg-teal-950 dark:text-teal-400 font-black"; // الحالي النشط
                }

                mapContainer.innerHTML += `
        <button onclick="jumpToQuestion(${idx})" class="w-full py-2 rounded-xl text-center text-[11px] font-bold  border border-transparent cursor-pointer ${stateClass}">
          ${idx + 1}
        </button>
      `;
            });
        }

        function saveAnswer(questionId, optionKey) {
            studentAnswers[questionId] = optionKey;
            renderTrackerMap();
            // إعادة بناء التنسيق البصري للخيار النشط فوراً عند الضغط
            renderActiveQuestion();
        }

        function navigateQuestion(direction) {
            currentQuestionIndex += direction;
            renderActiveQuestion();
            renderTrackerMap();
        }

        function jumpToQuestion(index) {
            currentQuestionIndex = index;
            renderActiveQuestion();
            renderTrackerMap();
        }

        function finishAndCalculateScore() {
            clearInterval(examCountdown);

            // حساب النتيجة بدقة واقعية
            let correctCount = 0;
            mockQuestions.forEach((q) => {
                if (studentAnswers[q.id] === q.correct) {
                    correctCount++;
                }
            });

            // إخفاء مساحة الحل وإرجاع الطالب للرئيسية
            document.getElementById("examActiveWorkspace").className = "hidden";
            document.getElementById("examsListView").className = "space-y-6 block";

            // حقن وتحديث كرت النتيجة الفوري في القائمة الجانبية بشكل فخم جداً
            const resultsContainer = document.getElementById("resultsLogContainer");
            const percent = Math.round((correctCount / mockQuestions.length) * 100);
            const colorClass =
                percent >= 50 ?
                "bg-emerald-50 dark:bg-emerald-950 text-emerald-600" :
                "bg-rose-50 dark:bg-rose-950 text-rose-600";
            const barColor = percent >= 50 ? "bg-emerald-500" : "bg-rose-500";

            resultsContainer.innerHTML = `
      <div class="bg-white dark:bg-slate-900 border-2 border-teal-500/30 p-4 rounded-3xl shadow-sm space-y-3 animate-scale-up">
        <div class="flex items-start justify-between gap-3">
          <div class="space-y-1">
            <h5 class="font-black text-slate-800 dark:text-zinc-100 text-xs">اختبار الرياضيات - الفصل الأول</h5>
            <p class="text-[10px] text-gray-400 font-medium">تم تقديمه الآن بنجاح وتوثيق درجتك الفورية</p>
          </div>
          <div class="${colorClass} font-black px-2.5 py-1 rounded-xl text-[11px] shrink-0">
            ${correctCount} / ${mockQuestions.length}
          </div>
        </div>
        <div class="w-full bg-gray-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
          <div class="${barColor} h-full rounded-full " style="width: ${percent}%"></div>
        </div>
        <div class="text-[10px] text-gray-400 flex justify-between items-center pt-1 font-medium">
          <span>نسبة النجاح الإجمالية: ${percent}%</span>
          <span class="text-teal-600 font-bold">✓ تم الحفظ بسجلات الإدارة</span>
        </div>
      </div>
    `;
        }
    </script>
@endsection
