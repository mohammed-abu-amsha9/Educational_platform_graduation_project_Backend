<?php

namespace App\Http\Controllers;

use App\Models\AssignmentSubmission;
use App\Models\Exam;
use App\Models\student_exam;
use App\Models\student_exam_result;
use App\Models\StudentExamAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class syncController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view('student.sync');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type = $request->input('type');
        $studentId = auth()->id();
        // --- 1. حفظ الواجب ---
        if ($type === 'SUBMIT_ASSIGNMENT') {
            $assignment = new AssignmentSubmission();
            $assignment->assignment_id = $request->input('assignment_id');
            $assignment->student_id = $studentId;
            if ($request->hasFile('file')) {
                $assignment->submitted_file_url = $request->file('file')->store('submissions', 'public');
            }
            $assignment->save();
            return response()->json(['success' => true]);
        }
        if (!$request->expectsJson()) {
            $request->headers->set('Accept', 'application/json');
        }

        if ($request->type == 'submit_quiz') {

            $examId = $request->exam_id;
            $questionId = $request->question_id;
            $selectedOptionId = $request->selected_option;
            $action = $request->action; // 👈 لازم نجيبها من الطلب
            $studentId = $studentId; // اللي عندك مسبقاً

            // 1. حفظ/تحديث إجابة السؤال (نفس منطق الأونلاين، بدون تكرار)
            if ($questionId && $selectedOptionId) {
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

            // 2. لو كان "إنهاء الاختبار"، نفّذ نفس منطق التصحيح والحفظ النهائي
            if ($action == 'finish') {

                student_exam::where('exam_id', $examId)
                    ->where('student_id', $studentId)
                    ->update([
                        'submit_time' => now()->toTimeString(),
                    ]);

                $exam = Exam::with('questions.options')->find($examId);

                $studentAnswers = StudentExamAnswer::where('student_id', $studentId)
                    ->where('exam_id', $examId)
                    ->get()
                    ->keyBy('question_bank_id');

                $totalQuestions = $exam->questions->count();
                $correctAnswersCount = 0;

                foreach ($exam->questions as $question) {
                    $savedAnswer = $studentAnswers->get($question->id);
                    $correctOption = $question->options->where('is_correct', 1)->first();

                    if ($savedAnswer && $correctOption && $savedAnswer->selected_option_id == $correctOption->id) {
                        $correctAnswersCount++;
                    }
                }

                $finalScore = $totalQuestions > 0 ? ($correctAnswersCount / $totalQuestions) * 100 : 0;

                // تأكد إنه ما في نتيجة سابقة قبل ما تنشئ وحدة جديدة (تجنب تكرار النتيجة كمان)
                student_exam_result::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'exam_id'    => $examId,
                    ],
                    [
                        'score_obtained'     => $finalScore,
                        'status'             => 'مصحح تلقائياً',
                        'submission_method'  => 'حساب الطالب الإلكتروني (مزامنة)',
                    ]
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'تم حفظ الاختبار بنجاح'
            ]);
        }
        return response()->json(['success' => true]);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
