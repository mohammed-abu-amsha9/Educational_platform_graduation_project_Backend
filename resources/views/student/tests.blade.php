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
                <!-- قسم الاختبارات المتاحة -->
                <div class="space-y-4">
                    <h4 class="font-black text-slate-800 dark:text-zinc-200 px-2 flex items-center gap-1.5">
                        <span>📝 الاختبارات المتاحة</span>
                    </h4>

                    @forelse($exams as $exam)
                        <div
                            class="bg-white dark:bg-slate-900 border border-gray-100 dark:border-slate-800/80 p-4 rounded-3xl shadow-sm hover:shadow-xl flex items-center justify-between gap-4 hover:border-teal-500/40">
                            <div class="space-y-2 flex-1 min-w-0">
                                <span
                                    class="bg-emerald-50 dark:bg-emerald-950/50 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-lg inline-flex items-center gap-1">
                                    <i class="fa-solid fa-cloud-arrow-up text-[8px]"></i> حقيقي
                                </span>

                                <!-- اسم الاختبار المخزن في الـ title -->
                                <h5 class="font-black text-slate-800 dark:text-zinc-100 text-xs truncate">
                                    {{ $exam->title }}
                                </h5>

                                <div class="flex items-center gap-3 text-gray-400 text-[10px] font-medium flex-wrap">
                                    <!-- استخراج اسم المادة النظيف بدون كلمة اختبار إذا أردت أو عرضه كما هو -->
                                    <span class="text-slate-500 dark:text-zinc-400 font-bold">
                                        {{ str_replace('اختبار ', '', $exam->title) }}
                                    </span>

                                    <!-- عدد الأسئلة الحقيقي القادم من جدول الربط -->
                                    <span>
                                        <i class="fa-solid fa-list-check ml-0.5 text-teal-600"></i>
                                        <span>{{ $exam->questions->count() }}</span> أسئلة
                                    </span>

                                    <!-- مدة الاختبار الحقيقية -->
                                    <span>
                                        <i class="fa-solid fa-clock ml-0.5 text-amber-500"></i>
                                        {{ $exam->Exam_duration }} دقائق
                                    </span>
                                </div>
                            </div>

                            <!-- زر بدء الاختبار وتمرير الـ ID الخاص به للاستخدام في الـ JavaScript المحرك للاختبار -->
                            <button onclick="startRealExamEngine({{ $exam->id }})"
                                class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-4 py-2 rounded-xl cursor-pointer shadow-3xs shrink-0">
                                بدء الاختبار
                                <i class="fa-solid fa-chevron-left text-[9px] mr-1"></i>
                            </button>
                        </div>
                    @empty
                        <!-- رسالة تظهر للطالب إذا لم يقم المعلمون بنشر أي اختبارات بعد -->
                        <div
                            class="bg-gray-50/50 dark:bg-slate-900/40 border border-dashed border-gray-200 dark:border-slate-800 p-8 rounded-3xl text-center text-gray-400">
                            لا توجد اختبارات متاحة لك حالياً.
                        </div>
                    @endforelse
                </div>

                <!-- قسم نتائج وتاريخ الاختبارات (متروك ثابت كلوج للجلسة الحالية كما في تصميمك) -->
                <div class="space-y-4">
                    <h4 class="font-black text-slate-800 dark:text-zinc-200 px-2">
                        📊 نتائج وتاريخ الاختبارات
                    </h4>
                    <div id="resultsLogContainer" class="space-y-3">
                        <div
                            class="bg-gray-50/50 dark:bg-slate-900/40 border border-dashed border-gray-200 dark:border-slate-800 p-8 rounded-3xl text-center text-gray-400">
                            لا توجد اختبارات مقدمة في الجلسة الحالية. اضغط بدء الاختبار لتجربة المحاكي الواقعي.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- مساحة عمل الاختبار النشط (تظهر عند الضغط على البدء) -->
        <div id="examActiveWorkspace" class="hidden grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">
            <div
                class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 p-4 rounded-3xl space-y-4 shadow-sm">
                <div class="text-center pb-3 border-b border-gray-100 dark:border-slate-800">
                    <p class="text-gray-400 font-bold text-[10px] mb-1">الوقت المتبقي</p>
                    <div
                        class="bg-rose-50 dark:bg-rose-950/40 border border-rose-100 dark:border-rose-900/30 text-rose-600 text-sm font-black py-1.5 rounded-xl inline-flex items-center justify-center gap-1.5 px-4 w-full">
                        <i class="fa-solid fa-stopwatch animate-pulse"></i>
                        <span id="realTimerDisplay">00:00</span>
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="font-bold text-slate-700 dark:text-zinc-300 text-[10px]">خريطة الأسئلة:</p>
                    <div id="questionsMapTracker" class="grid grid-cols-3 gap-2"></div>
                </div>

                <div
                    class="pt-2 border-t border-gray-100 dark:border-slate-800 text-[10px] text-gray-400 leading-normal space-y-1">
                    <p>💡 <span class="text-emerald-500 font-bold">الأخضر</span>: سؤال تم الإجابة عليه.</p>
                    <p>💡 <span class="text-teal-600 font-bold">النيون</span>: السؤال الحالي النشط.</p>
                </div>
            </div>

            <div
                class="lg:col-span-3 bg-white dark:bg-slate-900 border border-gray-200 hover:border-emerald-400 p-6 rounded-3xl shadow-sm flex flex-col min-h-[400px] justify-between">
                <div id="activeQuestionContainer" class="space-y-6"></div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-slate-800 mt-8">
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
        // متغيرات النظام لإدارة حالة الاختبار الحالي
        let currentQuestions = [];
        let currentIndex = 0;
        let userAnswers = {};
        let examTimerInstance = null;

        // 1. دالة بدء الاختبار عند الضغط على الزر
        window.startRealExamEngine = function(examId) {
            console.log("تم تشغيل محرك الاختبار للاختبار رقم: " + examId);

            const listView = document.getElementById('examsListView');
            const workspace = document.getElementById('examActiveWorkspace');

            if (listView && workspace) {
                listView.style.display = 'none';
                workspace.style.display = 'grid';
                workspace.classList.remove('hidden');
            }

            // إرسال الطلب بالمسار الصحيح تماماً ومسبوقاً بـ /
            fetch(`/api/get-exam-questions/${examId}`)
                .then(response => {
                    if (!response.ok) throw new Error('فشل السيرفر في الاستجابة للمسار المحدد');
                    return response.json();
                })
                .then(data => {
                    currentQuestions = data.questions;
                    if (!currentQuestions || currentQuestions.length === 0) {
                        alert('قاعدة البيانات ترجع مصفوفة فارغة، هذا الاختبار لا يحتوي على أسئلة!');
                        return;
                    }
                    startExamTimer(data.duration || 30);
                    renderQuestionsTrackerMap();
                    showQuestion(0);
                })
                .catch(error => {
                    console.error("خطأ الـ Fetch المتولد:", error);
                    alert("لم نتمكن من جلب الأسئلة، تفقد الـ Console لمعرفة السبب.");
                });
        }

        // 2. دالة عرض السؤال الحالي وخياراته
        function showQuestion(index) {
            const container = document.getElementById('activeQuestionContainer');
            const q = currentQuestions[index];

            // تحديد الخيار الذي اختاره الطالب سابقاً إن وجد
            const savedAnswer = userAnswers[q.id] || '';

            // بناء نص الخيارات (يفترض أن الأعمدة هي q1, q2, q3, q4 في جدول الأسئلة)
            container.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="bg-teal-600 text-white font-bold px-2.5 py-1 rounded-xl text-[10px]">سؤال ${index + 1}</span>
                        <p class="font-black text-slate-800 dark:text-zinc-100 text-sm leading-relaxed">${q.question_text}</p>
                    </div>

                    <div class="grid grid-cols-1 gap-3 mt-4">
                        ${['q1', 'q2', 'q3', 'q4'].map((key, i) => {
                            if(!q[key]) return '';
                            const isChecked = savedAnswer === q[key] ? 'checked' : '';
                            const activeClass = savedAnswer === q[key] ? 'border-teal-500 bg-teal-50/30 dark:bg-teal-950/20' : 'border-gray-100 dark:border-slate-800';

                            return `
                                                            <label onclick="selectAnswer(${q.id}, '${q[key]}', ${index})" class="flex items-center gap-3 border ${activeClass} p-3 rounded-2xl cursor-pointer hover:bg-gray-50 dark:hover:bg-slate-800/50 transition-all">
                                                                <input type="radio" name="q_${q.id}" value="${q[key]}" ${isChecked} class="accent-teal-600 scale-110">
                                                                <span class="text-slate-700 dark:text-zinc-300 font-bold">${q[key]}</span>
                                                            </label>
                                                        `;
                        }).join('')}
                    </div>
                </div>
            `;

            // تحديث أزرار التنقل (السابق / التالي / إنهاء)
            document.getElementById('prevQuestionBtn').disabled = (index === 0);

            if (index === currentQuestions.length - 1) {
                document.getElementById('nextQuestionBtn').classList.add('hidden');
                document.getElementById('submitExamFinalBtn').classList.remove('hidden');
            } else {
                document.getElementById('nextQuestionBtn').classList.remove('hidden');
                document.getElementById('submitExamFinalBtn').classList.add('hidden');
            }

            // تحديث مكان المؤشر في خريطة الأسئلة
            renderQuestionsTrackerMap();
        }

        // 3. حفظ الإجابة التي يختارها الطالب فوراً
        function selectAnswer(questionId, answerValue, index) {
            userAnswers[questionId] = answerValue;
            renderQuestionsTrackerMap();
        }

        // 4. التنقل بـ التالي والسابق
        function navigateQuestion(step) {
            currentIndex += step;
            if (currentIndex >= 0 && currentIndex < currentQuestions.length) {
                showQuestion(currentIndex);
            }
        }

        // 5. رسم خريطة الأسئلة (المؤشرات الجانبية)
        function renderQuestionsTrackerMap() {
            const mapContainer = document.getElementById('questionsMapTracker');
            mapContainer.innerHTML = currentQuestions.map((q, i) => {
                let btnClass = "bg-gray-100 dark:bg-slate-800 text-slate-400"; // غير مجاب عليه

                if (userAnswers[q.id]) {
                    btnClass = "bg-emerald-500 text-white"; // تم الإجابة
                }
                if (i === currentIndex) {
                    btnClass =
                        "ring-2 ring-teal-600 bg-teal-50 text-teal-700 dark:bg-slate-800 dark:text-teal-400 font-black"; // الحالي
                }

                return `
            <button onclick="jumpToQuestion(${i})" class="${btnClass} py-2 rounded-xl text-center font-bold font-mono transition-all">
                ${i + 1}
            </button>
        `;
            }).join('');
        }

        function jumpToQuestion(index) {
            currentIndex = index;
            showQuestion(currentIndex);
        }

        // 6. تشغيل عداد الوقت المتبقي تنازلياً
        function startExamTimer(minutes) {
            if (examTimerInstance) clearInterval(examTimerInstance);

            let timeRemaining = minutes * 60;
            const timerDisplay = document.getElementById('realTimerDisplay');

            examTimerInstance = setInterval(() => {
                let mins = Math.floor(timeRemaining / 60);
                let secs = timeRemaining % 60;

                timerDisplay.textContent =
                    `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;

                if (timeRemaining <= 0) {
                    clearInterval(examTimerInstance);
                    alert('انتهى وقت الاختبار! سيتم تسليم الإجابات تلقائياً.');
                    finishAndCalculateScore();
                }
                timeRemaining--;
            }, 1000);
        }

        // 7. إنهاء الاختبار وحساب النتيجة وعرض لوج النتيجة للطالب
        function finishAndCalculateScore() {
            clearInterval(examTimerInstance);

            // حساب النتيجة الفورية للعرض فقط
            let correctCount = 0;
            currentQuestions.forEach(q => {
                if (userAnswers[q.id] === q.correct_answer) {
                    correctCount++;
                }
            });

            const total = currentQuestions.length;
            const percentage = Math.round((correctCount / total) * 100);

            // تجهيز البيانات لإرسالها وحفظها في قاعدة البيانات
            // نرسل رقم الاختبار، الإجابات، والنتيجة المحسوبة
            const payload = {
                exam_id: currentQuestions[0] ? currentQuestions[0].exam_id : null, // أو مرري الـ examId الأصلي
                answers: userAnswers, // مصفوفة الإجابات المختارة
                score: percentage,
                _token: document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') // حماية لارافيل
            };

            // إرسال البيانات إلى السيرفر عبر مسار الـ API المستثنى
            fetch('/student/studentExams', { // تعديل الرابط هنا بإزالة .store
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                })
                .then(response => {
                    if (!response.ok) throw new Error('فشل في حفظ نتيجة الاختبار على السيرفر');
                    return response.json();
                })
                .then(data => {
                    alert('تم تسليم وحفظ الاختبار بنجاح!');
                    location.reload(); // تحديث الصفحة لرؤية السجل الجديد للدرجات
                })
                .catch(error => {
                    console.error(error);
                    alert('حدث خطأ أثناء حفظ النتيجة، تم احتسابها محلياً فقط.');
                });
        }
    </script>
@endsection
