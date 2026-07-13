@extends('student.parent')
@section('title', 'حل الاختبارات')
@section('content')

    <div class="w-full space-y-6 text-xs text-right" dir="rtl" id="examsMainContainer">

        <!-- حوايا الامتحان -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 items-start">

            <!-- القائمة الجانبية: خريطة الأسئلة من لارافيل -->
            <div class="lg:col-span-1 bg-white dark:bg-slate-900 border border-gray-200 p-4 rounded-3xl space-y-4 shadow-sm">
                <div class="space-y-2">
                    <p class="font-bold text-slate-700 dark:text-zinc-300 text-[10px]">خريطة الأسئلة:</p>

                    <div id="questionsMapTracker" class="grid grid-cols-3 gap-2">
                        @for ($i = 1; $i <= $questions->total(); $i++)
                            <!-- تحويلها إلى div عادي بدون روابط لعرض الرقم الحالي فقط بدون إمكانية الضغط والرجوع -->
                            <div
                                class="py-2 text-center rounded-xl font-bold text-xs
                {{ $questions->currentPage() == $i ? 'ring-2 ring-teal-500 bg-teal-50 text-teal-600' : 'bg-gray-100 dark:bg-slate-800 text-slate-400' }}">
                                {{ $i }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- منطقة السؤال الحالي (لارافيل يعرض سؤالاً واحداً فقط هنا بناءً على الـ Pagination) -->
            <div
                class="lg:col-span-3 bg-white dark:bg-slate-900 border border-gray-200 p-6 rounded-3xl shadow-sm flex flex-col min-h-[400px] justify-between">

                <!-- فورم لإرسال إجابة السؤال الحالي وتخزينها -->
                <form action="{{ route('studentExams.store') }}" method="POST"
                    window.location.href = "{{ route('syncs.index') }}";>
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                    @foreach ($questions as $question)
                        <input type="hidden" name="question_id" value="{{ $question->id }}">
                        <input type="hidden" name="page" value="{{ $questions->currentPage() }}">
                        <div class="space-y-2">
                            <span class="text-[10px] font-bold text-teal-600 uppercase">سؤال {{ $questions->currentPage() }}
                                من أصل {{ $questions->total() }}</span>
                            <h3 class="text-sm font-bold text-slate-800 dark:text-zinc-100 leading-relaxed">
                                {{ $question->question_text }}</h3>
                        </div>

                        <!-- عرض خيارات السؤال -->
                        <div class="grid grid-cols-1 gap-3 mt-4">
                            @foreach ($question->options as $option)
                                <label
                                    class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-slate-800/40 rounded-xl cursor-pointer">
                                    <!-- نتحقق إذا كان هناك إجابة مخزنة مسبقاً في السيشن لتبقى محددة -->
                                    <input type="radio" name="selected_option" value="{{ $option->id }}"
                                        {{ session("exam_answers.{$exam->id}.{$question->id}") == $option->id ? 'checked' : '' }}
                                        required class="text-teal-600 w-4 h-4">
                                    <span
                                        class="text-slate-700 dark:text-zinc-300 font-medium">{{ $option->option_text ?? $option->option }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    <!-- أزرار التنقل والإنهاء بالاعتماد على الـ PHP -->
                    <!-- أزرار التحكم والتنقل داخل الـ Blade -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-100 dark:border-slate-800 mt-8">

                        <!-- زر السؤال السابق: معطل دائماً ومغلق برمجياً وبصرياً -->
                        <button type="button" disabled
                            class="bg-gray-100 text-gray-400 font-bold px-4 py-2 rounded-xl opacity-40 cursor-not-allowed">
                            <i class="fa-solid fa-arrow-right ml-1"></i> السؤال السابق
                        </button>

                        <!-- إذا كان هناك سؤال تالي -->
                        @if ($questions->hasMorePages())
                            <button type="submit" name="action" value="next" id="nextQuestionBtn"
                                data-next-page="{{ $questions->currentPage() + 1 }}"
                                class="bg-slate-800 dark:bg-slate-700 text-white font-bold px-4 py-2 rounded-xl">
                                التالي وحفظ <i class="fa-solid fa-arrow-left mr-1"></i>
                            </button>
                        @else
                            <!-- إذا كان هذا هو السؤال الأخير -->
                            <button type="submit" id="finalSubmitBtn" name="action" value="finish"
                                class="bg-emerald-600 hover:bg-emerald-700 text-white font-black px-5 py-2 rounded-xl">
                                إنهاء وإرسال الإجابات <i class="fa-solid fa-check-double mr-1"></i>
                            </button>
                        @endif

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const actionButtons = document.querySelectorAll('button, input[type="submit"], .btn');

            actionButtons.forEach(button => {
                button.addEventListener("click", function(event) {
                    // إذا كان أونلاين، اتركه يعمل بشكل طبيعي جداً مع لارافيل والـ Pagination الافتراضي
                    if (window.isOnline()) {
                        return;
                    }

                    // إذا كان أوفلاين (أو محاكاة): نوقف الإرسال التلقائي للسيرفر لحماية البيانات
                    event.preventDefault();
                    event.stopPropagation();
                    event.stopImmediatePropagation();

                    // 1. تجميع الإجابات الحالية من الفورم لحمايتها
                    const quizForm = document.getElementById("quizForm");
                    let answers = {};
                    if (quizForm) {
                        let formData = new FormData(quizForm);
                        formData.forEach((value, key) => {
                            answers[key] = value;
                        });
                    }

                    let quizData = {
                        title: "إجابات اختبار معلقة",
                        form_data: answers,
                        created_at: new Date().toISOString()
                    };

                    // 2. التمييز الذكي بين إنهاء الاختبار وبين التنقل للتالي
                    if (button.id === "finalSubmitBtn") {
                        // حفظ العملية النهائية كاملة في IndexedDB كعملية تسليم نهائية
                        window.saveActionLocally('submit_quiz', quizData);

                        // تحويل الطالب فوراً لصفحة المزامنة (بدون إزعاج)
                        window.location.replace("{{ route('syncs.index') }}");
                    } else if (button.id === "nextQuestionBtn") {
                        // حفظ حالة السؤال الحالي محلياً كمسودة لحين توفر الإنترنت
                        window.saveActionLocally('save_draft_question', quizData);
                        console.log("تم حفظ إجابة السؤال الحالي محلياً كمسودة بنجاح.");

                        // [الحل السحري للأوفلاين]: نقوم ببناء رابط الصفحة التالية يدوياً وننقل الطالب إليها
                        // نأخذ رابط الصفحة الحالي (مثلا: exam/create?exam_id=1) ونضيف أو نعدل عليه الـ page
                        let currentUrl = new URL(window.location.href);
                        let nextPage = button.getAttribute('data-next-page');

                        currentUrl.searchParams.set('page', nextPage);

                        // انتقال صامت وسلس للصفحة التالية بدون تدخل السيرفر (ستعتمد على الكاش المحلي أو الـ Service Worker)
                        window.location.href = currentUrl.toString();
                    }
                });
            });
        });
    </script>
@endsection
