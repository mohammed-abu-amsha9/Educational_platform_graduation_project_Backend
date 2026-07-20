<?php

namespace App\Http\Controllers;

use App\Models\Attendance_log;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AttendanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $teacherId = auth()->id();

        // جلب المعلم مع الصفوف الموكلة إليه (عبر علاقة grades وموادها)
        $teacher = Teacher::with(['grades.sections', 'subjects.grade'])->find($teacherId);

        // استخراج الصفوف الفريدة التابعة للمعلم
        $teacherClasses = $teacher ? $teacher->grades : collect();

        $students = [];
        $existingAttendance = [];

        if ($request->has(['class_section', 'date']) && $request->input('class_section') != '') {

            // تفكيك "اسم_الصف|معرف_الشعبة" القادمة من الـ Select
            $parts = explode('|', $request->input('class_section'));

            if (count($parts) === 2) {
                $gradeId   = $parts[0]; // معرف الصف (Grade ID)
                $sectionId = $parts[1]; // معرف الشعبة (Section ID)

                // جلب الطلاب التابعين لهذا الصف وهذه الشعبة بدقة بناءً على المعرفات الرقمية (أفضل وأسرع وأدق لمشروعك)
                $students = Student::where('grade_id', $gradeId)
                    ->where('section_id', $sectionId)
                    ->get();

                // جلب الحضور السابق
                $existingAttendance = Attendance_log::where('date', $request->input('date'))
                    ->where('teacher_id', $teacherId)
                    ->whereIn('student_id', $students->pluck('id'))
                    ->pluck('status', 'student_id')
                    ->toArray();
            }
        }

        return view('teacher.attendance', [
            'teacherClasses'      => $teacherClasses, // 🟢 مصفوفة الصفوف المصلحة
            'students'           => $students,
            'existingAttendance' => $existingAttendance
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
        // 1. التحقق الصارم من صحة البيانات القادمة من المتصفح
        $request->validate([
            'date'         => 'required|date',
            'attendance'   => 'required|array',
            'attendance.*' => 'required|in:present,late,absent', // 🟢 ضمان أن الحالة المرسلة صحيحة فقط
        ]);

        // معرف المعلم الحالي (مثبت مؤقتاً برقم 1)
        $teacherId = auth()->id();

        // التاريخ المرسل من الحقل المخفي في الواجهة
        $date = $request->input('date');

        // 2. الدوران على مصفوفة الحضور لمعالجة كل طالب على حدة
        foreach ($request->input('attendance') as $studentId => $status) {

            // استخدام الدالة الذكية لـ (التحديث أو الإنشاء) لمنع تكرار البيانات
            Attendance_log::updateOrCreate(
                [
                    // شروط البحث (مفاتيح التحقق)
                    'student_id' => $studentId,
                    'date'       => $date,
                ],
                [
                    // البيانات المراد حفظها أو تحديثها
                    'teacher_id' => $teacherId,
                    'status'     => $status,
                ]
            );
        }

        // 3. إعادة التوجيه للخلف مع رسالة نجاح تظهر للمعلم
        return redirect()->back()->with('success', 'تم رصد وتحديث سجل الحضور والغياب بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(attendance_log $attendance_log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(attendance_log $attendance_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, attendance_log $attendance_log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(attendance_log $attendance_log)
    {
        //
    }
}
