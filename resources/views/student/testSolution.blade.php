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
                <form action="{{ route('studentExams.store') }}" method="POST">
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
            function showToast(message, isSuccess = false) {// عرض رسالة صفير بناج او فشل
                const container = document.getElementById('toast-container');

                if (container) {
                    const toast = document.createElement('div');

                    toast.className = `
                    ${isSuccess ? "bg-emerald-600" : "bg-rose-600"}
                    text-white px-6 py-3 rounded-2xl shadow-xl
                    pointer-events-auto animate-fade-in
                `;

                    toast.innerText = message;

                    container.appendChild(toast);

                    setTimeout(() => {
                        toast.remove();
                    }, 5000);
                }
            }

            // ربط الأزرار
            document.querySelectorAll('#finalSubmitBtn, #nextQuestionBtn').forEach(button => { // اي ضغطة على هدول الازرار
                button.addEventListener("click", function(event) {
                    if (window.isOnline()) return;

                    // منع الارسال الافتراضي
                    event.preventDefault();
                    event.stopPropagation(); // وقف انتشار حدث الضغط

                    let form = this.closest('form');

                    // استخدام FormData لجلب كل شيء من الفورم تلقائياً
                    let formData = new FormData(form);

                    // إضافة الأكشن بناءً على الزر
                    formData.append('action', this.id === "finalSubmitBtn" ? "finish" : "next");
                    formData.append('type', 'submit_quiz');
                    formData.append('student_id', 1);

                    // تحويل FormData إلى Object لحفظه في IndexedDB
                    let quizData = Object.fromEntries(formData.entries());

                    // حفظ البيانات
                    window.saveActionLocally('submit_quiz', quizData);
                    showToast("تم حفظ الاختبار محلياً، سيتم رفعه عند عودة الاتصال.", false);
                    /**
                     * إذا كان الزر المضغوط زر السؤال التالي النظام بيجلب رقم الصفحة التالية من
                     * data-next-page
                     * وبعدين ينتظر300 مللي ثانية وبعدين بيغيّر رابط الصفحة الحالية إلى الصفحة التالية باستخدام
                     * window dot location href
                     * فينتقل الطالب للسؤال التالي. سبب هذا التأخير البسيط هو إعطاء وقت قصير عشان تنحفظ البيانات محلياً وتظهر رسالة التنبيه قبل الانتقال للصفحة التالية
                    */
                    if (this.id === 'nextQuestionBtn') {
                        const nextPage = this.dataset.nextPage;

                        setTimeout(() => {
                            const url = new URL(window.location.href);

                            url.searchParams.set('page', nextPage);

                            window.location.href = url.toString();
                        }, 300);
                    }
                    // عند الانتهاء من الاختبار بينتظهر دقيقتين وبينتقل الى صفحة عرض الاختبارات
                    if (this.id === "finalSubmitBtn") {
                        setTimeout(() => {
                            window.location.replace("{{ route('studentExams.index') }}");
                        }, 2000);
                    }
                });
            });
        });
    </script>
@endsection
