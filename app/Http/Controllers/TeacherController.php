<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\grade_teacher;
use App\Models\role;
use App\Models\subject;
use App\Models\subject_teacher;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::with(['subjects', 'role'])->get();
        $roles = role::all();
        $grades = grade::with('sections')->get();

        // 🟢 جلب المواد من قاعدة البيانات لتصبح ديناميكية
        $subjects = subject::all();

        return view('admin.teachers', [
            'teachers' => $teachers,
            'roles'    => $roles,
            'grades'   => $grades,
            'subjects' => $subjects // مررنا المواد هنا
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
        $request->validate([
            'full_name'    => 'required|string|max:150',
            'phone_number' => 'required|string|max:20',
            'subjects'      => 'required|array',
            'role_id'      => 'required|exists:roles,id',
        ]);

        // اطلب من لارافيل فحص الجدول بالكامل حتى المحذوفين مؤقتاً
        $lastTeacher = Teacher::withTrashed()->latest('created_at')->first();


        if ($lastTeacher && preg_match('/TCH_(\d+)/', $lastTeacher->teacher_code, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        } else {
            $nextNumber = 1;
        }
        $teacherCode = 'TCH_' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
        // إنشاء المعلم
        $teacher = new Teacher();
        $teacher->full_name    = $request->input('full_name');
        $teacher->teacher_code = $teacherCode;
        $teacher->phone_number = $request->input('phone_number');
        $teacher->role_id      = $request->input('role_id');
        $teacher->save();

        // 4. إصلاح حفظ المواد في الجدول الوسيط (Many-to-Many)
        // نقوم بعمل حلقة تكرار لحفظ كل مادة تم اختيارها في الفورم بشكل مستقل
        foreach ($request->input('subjects') as $subjectId) {
            $subjectTeacher = new subject_teacher();
            $subjectTeacher->subject_id = $subjectId; // 🟢 المادة تأخذ ID المادة القادم من الفورم
            $subjectTeacher->teacher_id = $teacher->id; // 🟢 المعلم يأخذ ID المعلم الذي تم إنشاؤه للتو
            $subjectTeacher->save();
        }

        // إنشاء حساب المستخدم
        $user = new User();
        $user->id       = $teacher->id;
        $user->name     = $teacher->full_name;
        $user->password = Hash::make($teacher->id);
        $user->role_id     = $request->input('role_id');
        $user->save();
        foreach ($request->input('sections') as $sectionValue) {
            // 🟢 تنظيف القيمة: تحويل "grade_2" إلى رقم "2" فقط عبر حذف كلمة "grade_"
            $gradeId = str_replace('grade_', '', $sectionValue);

            $gradeTeacher = new grade_teacher(); // 💡 تم تعديل اسم الكائن ليكون معبراً بدلاً من $user
            $gradeTeacher->teacher_id = $teacher->id;
            $gradeTeacher->grade_id   = (int) $gradeId; // تحويله إلى رقم صحيح للتأكيد
            $gradeTeacher->save();
        }

        return redirect()->back()->with('success', 'تم إضافة المعلم بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(teacher $teacher)
    {
        //
    }
}
