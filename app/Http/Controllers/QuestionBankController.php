<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use App\Models\QuestionOption;
use App\Models\TeacherAcademicLevel;
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
        $teacherClasses = TeacherAcademicLevel::where('teacher_id', $teacherId)->get();
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
            'academic_level_subject' => 'required|string',
            'question_text'          => 'required|string',
            'question_type'          => 'required|in:mcq,tf',
            'difficulty_level'       => 'required|in:easy,medium,hard',
        ]);

        $teacher_id = 1; // مُثبت مؤقتاً لمشروع التخرج

        // 2. حفظ السطر الرئيسي في جدول الـ question_banks
        $questionBank = new QuestionBank();
        $questionBank->teacher_id             = $teacher_id;
        $questionBank->academic_level_subject = $request->input('academic_level_subject');
        $questionBank->question_text          = $request->input('question_text');
        $questionBank->question_type          = $request->input('question_type');
        $questionBank->difficulty_level       = $request->input('difficulty_level');
        $questionBank->save();

        // 3. ذكاء التخزين: الفصل بناءً على نوع السؤال
        if ($request->input('question_type') === 'mcq') {

            // التحقق من وصول مصفوفة الخيارات الأربعة
            $request->validate([
                'options'        => 'required|array|min:2',
                'correct_answer' => 'required|integer',
            ]);

            // الدوران لتخزين الخيارات الأربعة بالكامل
            foreach ($request->input('options') as $index => $optionText) {
                if (!empty($optionText)) {
                    $option = new QuestionOption();
                    $option->question_bank_id = $questionBank->id;
                    $option->option_text      = $optionText;
                    // إذا كان رقم اللفة الحالية يساوي الرقم المختار في الـ radio يعتبر الإجابة الصحيحة
                    $option->is_correct       = ($index == $request->input('correct_answer'));
                    $option->save();
                }
            }
        } else {
            // إذا كان نوع السؤال صح أو خطأ (tf)
            $request->validate([
                'tf_correct' => 'required|in:صح,خطأ',
            ]);

            // تخزين خيارين فقط في جدول الخيارات (صح) و (خطأ) وتحديد أيهما الصحيح
            $answers = ['صح', 'خطأ'];
            foreach ($answers as $ans) {
                $option = new QuestionOption();
                $option->question_bank_id = $questionBank->id;
                $option->option_text      = $ans;
                $option->is_correct       = ($ans === $request->input('tf_correct'));
                $option->save();
            }
        }

        // تعديل رسالة النجاح لتناسب السياق
        return redirect()->back()->with('success', 'تم إضافة السؤال وإعداد خيارات الإجابة بنجاح في البنك!');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuestionBank $questionBank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuestionBank $questionBank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuestionBank $questionBank)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $question = QuestionBank::findOrFail($id);
        $question->options()->delete();
        $question->delete();
        return redirect()->back()->with('success', 'تم حذف السؤال وكافة خياراته التابعة له بنجاح!');
    }
}
