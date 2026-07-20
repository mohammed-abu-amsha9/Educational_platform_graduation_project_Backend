<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\student_exam;
use App\Models\student_exam_result;
use App\Models\StudentExamAnswer;
use App\Models\StudentExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // جلب الاختبارات المنشورة مع جلب علاقة الـ examQuestions التابعة لها
        $exams = Exam::where('status', 'Published')->get();

        return view('student.tests', ['exams' => $exams]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // 1. استقبال رقم الامتحان من الرابط
        $examId = $request->query('exam_id');
        $studentId = auth()->id();


        // 2. جلب الامتحان مع الأسئلة والخيارات الخاصة بكل سؤال دفعة واحدة وبسطر واحد!
        // 1. جلب الامتحان للتأكد من وجوده
        $exam = Exam::find($examId);
        if (!$exam) {
            return redirect()->back()->with('error', 'الامتحان غير موجود!');
        }

        // 2. ✨ [المنطق الجديد]: تسجيل دخول الطالب في جدول student_exams إذا لم يكن مسجلاً مسبقاً
        // نستخدم firstOrCreate لحمايته من إنشاء سجل جديد في كل مرة ينتقل فيها بين صفحات الأسئلة
        student_exam::firstOrCreate(
            // 1. ابحث بدلالة هذه الحقول الثابتة فقط
            [
                'exam_id'    => $examId,
                'student_id' => $studentId,
            ],
            // 2. إذا لم تجده، أنشئ السجل واكتب فيه هذه البيانات (مرة واحدة فقط عند أول دخول)
            [
                'enter_time'  => now()->toTimeString(), // تسجيل وقت الدخول الفعلي الآن
                'submit_time' => 'لم يسلم بعد',       // قيمة افتراضية حتى يضغط إنهاء
            ]
        );

        // 2. جلب الأسئلة المرتبطة بالامتحان مجزأة (سؤال واحد في كل صفحة) مع خياراتها
        // لارافيل سيتعرف تلقائياً على رقم السؤال من الرابط عبر المتغير ?page=1
        $questions = $exam->questions()->with('options')->paginate(1);
        return response()->view('student.testSolution', ['exam' => $exam, 'questions' => $questions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ==========================================
        // الحاجة 1: استقبال البيانات الأساسية من الـ Form
        // ==========================================
        $examId = $request->input('exam_id');
        $questionId = $request->input('question_id');
        $selectedOptionId = $request->input('selected_option'); // رقم الخيار المحدد
        $action = $request->input('action'); // نوع الزر (next أو finish)
        $studentId = auth()->id(); // معرف الطالب الحالي

        // ب) حفظ إجابة السؤال الحالي فوراً في قاعدة البيانات
        if ($questionId && $selectedOptionId) {
            // نستخدم updateOrCreate للتأكد من عدم تكرار الإجابة لنفس السؤال؛
            // المصفوفة الأولى للبحث عن إجابة سابقة، والثانية لتحديث الخيار فقط.
            StudentExamAnswer::updateOrCreate(
                [
                    'student_id'       => $studentId,
                    'exam_id'          => $examId,
                    'question_bank_id' => $questionId
                ],
                [
                    'selected_option_id' => $selectedOptionId
                ]
            );
        }

        // ✨ حماية الانتقال: تأكدي أن هذا الجزء خارج شرط الحفظ الفوقي تماماً
        if ($action === 'next') {
            // جلب رقم الصفحة الحالية (إذا لم تجده افترض 1) وزيادته بمقدار 1
            $currentPage = $request->input('page', 1);
            $nextPage = $currentPage + 1;

            return redirect()->route('studentExams.create', [
                'exam_id' => $examId,
                'page'    => $nextPage
            ]);
        }

        // د) إذا ضغط الطالب على "إنهاء وإرسال الإجابات"
        if ($action === 'finish') {

            // 1. تحديث وقت تسليم الامتحان الفعلي في جدول student_exams
            student_exam::where('exam_id', $examId)
                ->where('student_id', $studentId)
                ->update([
                    'submit_time' => now()->toTimeString(), // تسجيل وقت التسليم الحالي
                ]);
            // 2. جلب الامتحان مع الأسئلة والخيارات باستخدام Eloquent Model
            $exam = Exam::with('questions.options')->find($examId);

            // 3. جلب كل الإجابات الفردية التي حفظناها للطالب في خطوة (1) لهذا الامتحان
            $studentAnswers = StudentExamAnswer::where('student_id', $studentId)
                ->where('exam_id', $examId)
                ->get()
                ->keyBy('question_bank_id'); // ترتيبها برقم السؤال ليسهل جلبها

            $totalQuestions = $exam->questions->count(); // إجمالي أسئلة الامتحان
            $correctAnswersCount = 0; // عدّاد الإجابات الصحيحة

            // 4. حلقة المقارنة والتصحيح التلقائي
            foreach ($exam->questions as $question) {

                // استخراج إجابة الطالب المحفوظة لهذا السؤال بالذات
                $savedAnswer = $studentAnswers->get($question->id);

                // استخراج الخيار الصحيح المخزن في جدول خيارات الأسئلة (حيث is_correct يساوي 1)
                $correctOption = $question->options->where('is_correct', 1)->first();

                // التحقق: إذا كان الطالب حل السؤال، وكانت إجابته تطابق تماماً رقم الخيار الصحيح
                if ($savedAnswer && $correctOption && $savedAnswer->selected_option_id == $correctOption->id) {
                    $correctAnswersCount++; // زيادة نقاط الطالب نقطة واحدة
                }
            }

            // 5. حساب النسبة المئوية المحصلة
            $finalScore = $totalQuestions > 0 ? ($correctAnswersCount / $totalQuestions) * 100 : 0;

            // 6. الحفظ النهائي والرسمي في جدول نتيجة اختبار الطالب student_exam_results
            $student_exam_result = new student_exam_result();
            $student_exam_result->student_id = $studentId;
            $student_exam_result->exam_id = $examId;
            $student_exam_result->score_obtained = $finalScore;
            $student_exam_result->status = 'مصحح تلقائياً'; // حالة الرصد والتدقيق
            $student_exam_result->submission_method = 'حساب الطالب الإلكتروني'; // طريقة تقديم الطالب للامتحان
            $student_exam_result->save();
            // 7. التوجيه النهائي للوحة التحكم أو قائمة الاختبارات مع رسالة نجاح
            return redirect()->route('studentExams.index')->with('success', "تم إنهاء الاختبار ورصد النتيجة بنجاح!");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(student_exam $student_exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student_exam $student_exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student_exam $student_exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student_exam $student_exam)
    {
        //
    }
}
