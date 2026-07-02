<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Student;
use App\Models\TeacherAcademicLevel;
use Illuminate\Http\Request;

class AttendanceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // هنا نقوم بتثبيت رقم المعلم مؤقتاً بـ 1
        //لاحقاً عندما تفعل نظام تسجيل الدخول، سنستبدله بـ Auth::id()
        //ليعرف النظام تلقائياً من هو المعلم الذي فتح الصفحة
        $teacherId = 1;
        //نذهب لجدول "المستويات الأكاديمية للمعلمين" ونقول له: "يا قاعدة البيانات، أعطني كل الصفوف والشُعب الموكلة لهذا المعلم فقط
        $teacherClasses = TeacherAcademicLevel::where('teacher_id', $teacherId)->get();
        /**
         * هنا نقوم بتجهيز متغيرات فارغة مسبقاً. لماذا
         * لأن المعلم أول ما يفتح الصفحة يكون لم يضغط على زر "بحث" بعد
         * فلو لم نجهز هذه المتغيرات فارغة، سيرمي الـ Blade
         * خطأ ويقول "أنت تحاول عرض جدول طلاب غير موجودين أصلاً
         */
        $students = [];
        $existingAttendance = [];

        if ($request->has(['class_section', 'date']) && $request->input('class_section') != '') {

            // سطر السحر البرمجي: تفكيك "الأول إعدادي|1" إلى جزئين
            $parts = explode('|', $request->input('class_section'));

            $academicLevel = $parts[0]; // يأخذ الجزء الأول: "الأول إعدادي"
            $sectionName   = $parts[1]; // يأخذ الجزء الثاني: الشعبة"

            // 2. جلب الطلاب بناءً على "الصف" و "الشعبة" معاً بدقة
            $students = Student::where('academic_level', $academicLevel)
                ->where('section_name', $sectionName)
                ->get();

            // 3. جلب الحضور السابق بناءً على التاريخ والطلاب (كما هي بدون تغيير)
            $existingAttendance = AttendanceLog::where('date', $request->input('date')) //يفحص جدول الحضور بناءً على التاريخ الذي حدده المعلم في الواجهة
                ->where('teacher_id', $teacherId)
                ->whereIn('student_id', $students->pluck('id')) // يفحص فقط حضور الطلاب التابعين لهذا الصف (الذين جلبناهم في الخطوة السابقة).
                ->pluck('status', 'student_id') // هذه دالة ذكية جداً في لارافل، تأخذ البيانات من قاعدة البيانات وتحولها إلى مصفوفة بشكل مفتاح وقيمة هكذا: [ 'رقم الطالب' => 'حالته' ]
                ->toArray();
        }

        return view('teacher.attendance', [
            'teacherClasses'     => $teacherClasses,
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
        // 1. التحقق من صحة البيانات القادمة من المتصفح (Validation)
        $request->validate([
            'date'       => 'required|date',
            'attendance' => 'required|array', // يجب أن تكون مصفوفة تحتوي على [student_id => status]
        ]);

        // معرف المعلم الحالي (مُثبت مؤقتاً برقم 1 كما اتفقنا)
        $teacherId = 1;

        // التاريخ المرسل من الحقل المخفي في الواجهة
        $date = $request->input('date');

        // 2. الدوران على مصفوفة الحضور لمعالجة كل طالب على حدة
        foreach ($request->input('attendance') as $studentId => $status) {

            // استخدام الدالة الذكية لـ (التحديث أو الإنشاء) لمنع تكرار البيانات
            AttendanceLog::updateOrCreate(
                [
                    // شروط البحث: ابحث أولاً هل يوجد سجل لهذا الطالب في هذا التاريخ بالذات؟
                    'student_id' => $studentId,
                    'date'       => $date,
                ],
                [
                    // البيانات المراد حفظها أو تحديثها في حال إيجاد السجل أو إنشائه:
                    'teacher_id' => $teacherId,
                    'status'     => $status, // القيمة القادمة: إما 'present' أو 'absent' أو 'late'
                ]
            );
        }

        // 3. إعادة التوجيه للخلف مع رسالة نجاح تظهر للمعلم
        return redirect()->back()->with('success', 'تم رصد وتحديث سجل الحضور والغياب بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(AttendanceLog $attendanceLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AttendanceLog $attendanceLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttendanceLog $attendanceLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AttendanceLog $attendanceLog)
    {
        //
    }
}
