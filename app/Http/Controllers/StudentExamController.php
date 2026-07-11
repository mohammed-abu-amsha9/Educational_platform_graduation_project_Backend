<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\student_exam;
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
    public function getExamQuestions($id)
    {
        try {
            // 1. جلب بيانات الامتحان
            $exam = DB::table('exams')->where('id', $id)->first();

            if (!$exam) {
                return response()->json(['error' => 'الامتحان غير موجود'], 404);
            }

            // 2. جلب معرفات الأسئلة من جدول الربط
            $questionIds = DB::table('exam_questions')
                ->where('exam_id', $id)
                ->pluck('question_bank_id');

            // 3. جلب الأسئلة
            $questions = DB::table('question_banks')
                ->whereIn('id', $questionIds)
                ->get();

            // 4. دمج خيارات الإجابة من جدول question_options لكل سؤال
            foreach ($questions as $question) {
                // جلب الخيارات المرتبطة بهذا السؤال تحديداً
                // يفترض هنا أن حقل الربط في جدول الخيارات اسمه question_bank_id
                $options = DB::table('question_options')
                    ->where('question_bank_id', $question->id)
                    ->get();

                // سنقوم بتوزيع الخيارات الأربعة ليتعرف عليها كود الـ JavaScript المكتوب سابقاً (q1, q2, q3, q4)
                $question->q1 = $options[0]->option_text ?? ($options[0]->option ?? '');
                $question->q2 = $options[1]->option_text ?? ($options[1]->option ?? '');
                $question->q3 = $options[2]->option_text ?? ($options[2]->option ?? '');
                $question->q4 = $options[3]->option_text ?? ($options[3]->option ?? '');
            }

            // 5. إرجاع الأسئلة كاملة بالخيارات للمتصفح
            return response()->json([
                'duration' => $exam->Exam_duration ?? 30,
                'questions' => $questions
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'حدث خطأ أثناء دمج الخيارات: ' . $e->getMessage()
            ], 500);
        }
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
        try {
            // تأكدي من طريقة جلب معرف الطالب في مشروعك (Auth::id() أو حقل مخصص)
            $studentId =  1;

            // تأكدي من أسماء الأعمدة في جدول student_exams لديكِ في الـ Migration
            DB::table('student_exams')->insert([
                'student_id'   => $studentId,
                'exam_id'      => $request->input('exam_id'),
                'score'        => $request->input('score'), // هل اسم العمود score أم mark أم grade؟
                // إذا كان الجدول لا يحتوي على حقل answers_log، قومي بتعطيل السطر التالي مؤقتاً بالـ //
                'answers_log'  => json_encode($request->input('answers')),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم الحفظ بنجاح'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => 'خطأ السيرفر: ' . $e->getMessage()
            ], 500);
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
