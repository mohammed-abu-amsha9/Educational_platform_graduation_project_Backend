<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Exam_question;
use App\Models\QuestionBank;
use App\Models\subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = auth()->id();
        // جلب المعلم مع المواد المربوطة به، والصفوف المربوطة به مباشرة عبر جدول الربط
        $currentTeacher = Teacher::with(['subjects', 'grades'])->find($teacherId);

        // نرسل الصفوف والمواد الخاصة بهذا المعلم فقط إلى الـ Blade
        $teacherSubjects = $currentTeacher ? $currentTeacher->subjects : collect();
        $teacherGrades = $currentTeacher ? $currentTeacher->grades->unique('id') : collect();
        return view('teacher.test_generator', [
            'teacherSubjects' => $teacherSubjects,
            'teacherGrades' => $teacherGrades,
        ]);
    }

    // دالة جلب الأسئلة العشوائية للمعاينة الحية (AJAX)
    public function fetchQuestions(Request $request)
    {
        $classSection = $request->input('class_section');
        $totalQuestions = $request->input('total_questions', 5);

        if (!$classSection) {
            return response()->json(['success' => false, 'message' => 'الرجاء تحديد الصف والمادة أولاً'], 400);
        }

        // تفكيك سلسلة "grade_id|subject_id"
        $parts = explode('|', $classSection);
        $gradeId = $parts[0] ?? null;
        $subjectId = $parts[1] ?? null;

        // سحب الأسئلة عشوائياً من بنك الأسئلة بناءً على الفلاتر
        // ملاحظة: تأكد من شحن علاقة الخيارات إذا كانت الأسئلة اختيار من متعدد بـ with('options')
        $questions = QuestionBank::with('options')
            ->where('grade_id', $gradeId)
            ->where('subject_id', $subjectId)
            ->inRandomOrder()
            ->limit($totalQuestions)
            ->get();

        if ($questions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'عذراً، لا توجد أسئلة كافية متوفرة في بنك الأسئلة لهذا الصف والمادة.'
            ]);
        }

        return response()->json([
            'success' => true,
            'questions' => $questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::all();
        return response()->view('teacher.exams', ['exams' => $exams]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. التحقق من صحة البيانات القادمة من الفورم
        $validatedData = $request->validate([
            'class_section'    => 'required|string', // يحتوي على "grade_id|subject_id"
            'Total_score'      => 'required|numeric|min:1',
            'total_questions'  => 'required|integer|min:1',
            'Exam_duration'    => 'required|integer|min:5',
            'Start_time'       => 'required',
            'End_Time'         => 'required',
            'question_ids'     => 'required|array|min:1', // مصفوفة الـ IDs التي حقنها الجافاسكريبت
            'question_ids.*'   => 'required|integer',
        ]);
        // 2. تفكيك قيمة الـ class_section (مثال: "1|3" تصبح صفيف يحتوي على 1 و 3)
        $parts = explode('|', $request->input('class_section'));
        $gradeId   = $parts[0] ?? null;
        $subjectId = $parts[1] ?? null; // هذا هو معرف المادة الذي نحتاجه

        // 3. جلب اسم المادة من قاعدة البيانات بناءً على الـ ID
        // (تأكد من تغيير \App\Models\Subject إلى اسم موديل المادة الصحيح لديك في المشروع)
        $subject = subject::find($subjectId);

        // إذا عثرنا على المادة نأخذ اسمها، وإلا نضع اسماً افتراضياً احتياطياً
        $subjectName = $subject ? $subject->name : 'مادة دراسية';

        $teacherId = auth()->id();
        $exam = new Exam();
        $exam->teacher_id = $teacherId;
        $exam->title = "اختبار " . $subjectName;
        $exam->Total_score = $request->input('Total_score');
        $exam->total_questions = $request->input('total_questions');
        $exam->Exam_duration = $request->input('Exam_duration');
        $exam->Start_time = $request->input('Start_time');
        $exam->End_Time = $request->input('End_Time');
        $exam->status = 'Unpublished';
        $exam->save();

        // 3. الحل: الدوران على المصفوفة وحفظ كل سؤال في جدول exam_questions
        foreach ($request->input('question_ids') as $questionId) {
            $examQuestion = new Exam_question(); // تأكد من كتابة اسم الموديل لحالة الأحرف الصحيحة لديك مثل ExamQuestion
            $examQuestion->exam_id = $exam->id; // الـ id الذي تم توليده فورًا بعد الـ save للأعلى
            $examQuestion->question_bank_id = $questionId; // رقم السؤال القادم من البنك في هذه اللفة
            $examQuestion->save();
        }
        return redirect()->back()->with('success', 'تم اعتماد الامتحان');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $teacherId = auth()->id();
        // التحقق من أن هذا المعلم هو المالك الفعلي للاختبار قبل تعديله لحماية النظام
        if ($exam->teacher_id !== $teacherId) {
            abort(403, 'غير مصرح لك بتعديل هذا الاختبار.');
        }

        // تحديث الحالة وحفظها
        $exam->status = 'Published';
        $exam->save();

        return redirect()->back()->with('success', 'تم تفعيل ونشر الاختبار بنجاح للطلاب!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // 1. جلب الاختبار المطلوب حذفه، أو إظهار خطأ 404 إذا لم يكن موجوداً
        $exam = Exam::findOrFail($id);
        // 3. حذف الاختبار (وبسبب الـ cascade سيتم حذف أسئلته من جدول exam_questions تلقائياً)
        $exam->delete();

        // 4. العودة إلى الصفحة السابقة مع رسالة تأكيد النجاح
        return redirect()->back()->with('success', 'تم حذف الاختبار وجميع الأسئلة المرتبطة به بنجاح.');
    }
}
