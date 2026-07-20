<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentExamResult;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentExamResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $teacherId = auth()->id();

        // 1. جلب المعلم مع المواد والصفوف والشعب (مع منع التكرار لاحقاً)
        $currentTeacher = Teacher::with(['subjects', 'grades.sections'])->find($teacherId);

        // 2. استقبال معرف الشعبة المختارة من الرابط
        $selectedSection = $request->input('section_id');

        // 3. افتراضياً مصفوفة الطلاب فارغة
        $students = collect();

        // 4. إذا قام المعلم باختيار شعبة وضغط زر الجلب، نذهب لقاعدة البيانات ونجلب طلابها
        if ($selectedSection) {
            $students = Student::where('section_id', $selectedSection)->with('examResults')->get();
        }

        // 5. تمرير المتغيرات للـ Blade
        return view('teacher.exams_manage', [
            'currentTeacher' => $currentTeacher,
            'selectedSection' => $selectedSection,
            'students'       => $students
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentExamResult $studentExamResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentExamResult $studentExamResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentExamResult $studentExamResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentExamResult $studentExamResult)
    {
        //
    }
}
