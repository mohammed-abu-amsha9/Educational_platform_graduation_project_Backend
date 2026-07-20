<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use App\Models\subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class materialContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 1. جلب معرف المستخدم الحالي (الطالب المسجل دخوله)
        $studentId = auth()->id();

        // 2. جلب بيانات الطالب من جدول students بناءً على معرف المستخدم لجلب رقم الصف (grade_id)
        // ملاحظة: بما أن id الطالب في قاعدة بياناتك هو نفسه id في جدول users (مثل 959295995)
        $student = Student::find($studentId);

        // حماية في حال لم يتم العثور على سجل الطالب
        if (!$student) {
            return redirect()->back()->with('error', 'حساب الطالب غير معرف.');
        }

        // جلب المواد الخاصة بصف الطالب مع معلميها
        $contents = subject::where('grade_id', $student->grade_id)
            ->with('teachers')
            ->get();

        $data = [];
        foreach ($contents as $subject) {
            foreach ($subject->teachers as $teacher) {

                // حساب عدد الدروس النشطة فقط (والتأكد أنها غير محذوفة)
                $lessonCount = Lesson::where('subject_id', $subject->id)
                    ->where('teacher_id', $teacher->id)
                    ->count();

                // قمنا بإلغاء الشرط لكي تظهر المادة دائماً حتى لو كانت 0
                $data[] = (object)[
                    'id' => $subject->id . '_' . $teacher->id,
                    'subject_id' => $subject->id,
                    'teacher_id' => $teacher->id,
                    'subject_name' => $subject->name,
                    'teacher_name' => $teacher->full_name,
                    'lessons_count' => $lessonCount // ستعرض 0 إذا حُذفت الدروس
                ];
            }
        }
        return response()->view('student.materials', ['contents' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('student.contentMaterials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $subject_id)
    {
        // جلب الـ teacher_id القادم من رابط زر الفتح
        $teacher_id = $request->query('teacher_id');

        // جلب بيانات المادة والمعلم للتأكد من وجودهم (ولعرض أسمائهم في أعلى الصفحة كعنوان)
        $subject = subject::findOrFail($subject_id);
        $teacher = Teacher::findOrFail($teacher_id);

        // جلب الدروس التابعة للمادة المحددة والمعلم المحدد فقط
        $lessons = lesson::where('subject_id', $subject_id)
            ->where('teacher_id', $teacher_id)
            ->get();

        // إرسال الدروس وبيانات المادة والمعلم إلى صفحة العرض
        return view('student.contentMaterials', compact('lessons', 'subject', 'teacher'));
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
