<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\QuestionBank;
use App\Models\QuestionOption;
use App\Models\teacher;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teacherId = 1;
        // 1. بناء الاستعلام الأساسي مع حصر الأسئلة التابعة لهذا المعلم فقط
        $query = QuestionBank::where('teacher_id', $teacherId);
        // 2. الفرز الذكي: إذا اختار المعلم نوعاً معيناً ولم يكن "all"
        if ($request->has('question_type') && $request->input('question_type') !== 'all') {
            $query->where('question_type', $request->input('question_type'));
        }

        // 3. الفرز الذكي حسب الصف والمادة
        if ($request->has('class_section') && !empty($request->input('class_section'))) {
            $query->where('academic_level_subject', $request->input('class_section'));
        }

        // 3. جلب الأسئلة المفلترة
        $questionBank = $query->get();
        $teacherClasses = grade::with('subjects')->get();
        return view('teacher.questions', [
            'teacherClasses' => $teacherClasses,
            'questionBank' => $questionBank
        ]);
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
        // 1. التحقق من البيانات الأساسية للسؤال
        $request->validate([
            'class_section'    => 'required|string', // الحقل الذي يحتوي على الصف والمادة معاً
            'question_text'    => 'required|string',
            'question_type'    => 'required|in:mcq,tf',
            'difficulty_level' => 'required|in:easy,medium,hard',
        ]);

        $teacher_id = 1; // مُثبت مؤقتاً لمشروع التخرج

        // تفكيك سلسلة "الصف|المادة" المرسلة من الـ Blade
        $parts = explode('|', $request->input('class_section'));
        if (count($parts) !== 2) {
            return redirect()->back()->with('error', 'بيانات الصف والمادة غير صالحة.');
        }

        $gradeId   = $parts[0];
        $subjectId = $parts[1];

        // 2. حفظ السطر الرئيسي في جدول الـ question_banks مطابقاً للـ Migration
        $questionBank = new QuestionBank();
        $questionBank->teacher_id       = $teacher_id;
        $questionBank->grade_id         = $gradeId;   // 🟢 حفظ حقل الصف الدراسي
        $questionBank->subject_id       = $subjectId; // 🟢 حفظ حقل المادة الدراسية
        $questionBank->question_text    = $request->input('question_text');
        $questionBank->question_type    = $request->input('question_type');
        $questionBank->difficulty_level = $request->input('difficulty_level');
        $questionBank->save();

        // 3. ذكاء التخزين: الفصل بناءً على نوع السؤال
        if ($request->input('question_type') === 'mcq') {

            $request->validate([
                'options'        => 'required|array|min:2',
                'correct_answer' => 'required|integer',
            ]);

            foreach ($request->input('options') as $index => $optionText) {
                if (!empty($optionText)) {
                    $option = new QuestionOption();
                    $option->question_bank_id = $questionBank->id;
                    $option->option_text      = $optionText;
                    $option->is_correct       = ($index == $request->input('correct_answer'));
                    $option->save();
                }
            }
        } else {
            // إذا كان نوع السؤال صح أو خطأ (tf)
            $request->validate([
                'tf_correct' => 'required|in:صح,خطأ',
            ]);

            $answers = ['صح', 'خطأ'];
            foreach ($answers as $ans) {
                $option = new QuestionOption();
                $option->question_bank_id = $questionBank->id;
                $option->option_text      = $ans;
                $option->is_correct       = ($ans === $request->input('tf_correct'));
                $option->save();
            }
        }

        return redirect()->back()->with('success', 'تم إضافة السؤال وإعداد خيارات الإجابة بنجاح في البنك!');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionBank $QuestionBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionBank $QuestionBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestionBank $QuestionBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionBank $QuestionBank)
    {
        //
    }
}
