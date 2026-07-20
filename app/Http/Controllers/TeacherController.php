<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\Grade_teacher;
use App\Models\QuestionBank;
use App\Models\role;
use App\Models\section;
use App\Models\subject;
use App\Models\Subject_teacher;
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
        // 🟢 قمنا بإضافة 'grades' هنا لجلب صفوف المعلم من الجدول الوسيط تلقائياً
        $teachers = Teacher::with(['subjects', 'sections', 'role'])->get();
        $roles = role::all();
        $grades = grade::with('sections')->get(); // كل الصفوف المتاحة في النظام
        // 🟢 جلب المواد من قاعدة البيانات لتصبح ديناميكية
        $subjects = subject::all();
        return view('admin.teachers', [
            'teachers' => $teachers,
            'roles'    => $roles,
            'grades'   => $grades,
            'subjects' => $subjects, // مررنا المواد هنا
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
        $teacher->id    = $request->input('id');
        $teacher->full_name    = $request->input('full_name');
        $teacher->teacher_code = $teacherCode;
        $teacher->phone_number = $request->input('phone_number');
        $teacher->role_id      = $request->input('role_id');
        $teacher->save();

        // 4. إصلاح حفظ المواد في الجدول الوسيط (Many-to-Many)
        // نقوم بعمل حلقة تكرار لحفظ كل مادة تم اختيارها في الفورم بشكل مستقل
        foreach ($request->input('subjects') as $subjectId) {
            $subjectTeacher = new Subject_teacher();
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
        // 1️⃣ أولاً: حفظ الصفوف والشعب (الشعب التي تحتوي على section_id)
        if ($request->has('sections')) {
            foreach ($request->input('sections') as $sectionId) {
                // جلب الـ Section لمعرفة الـ grade_id المرتبط به تلقائياً من قاعدة البيانات
                $section = section::find($sectionId); // تأكد من مسار الموديل لديك

                if ($section) {
                    $gradeTeacher = new Grade_teacher();
                    $gradeTeacher->teacher_id = $teacher->id;
                    $gradeTeacher->grade_id   = $section->grade_id; // جلب رقم الصف تلقائياً من الشعبة
                    $gradeTeacher->section_id = (int) $sectionId;   // 🟢 حفظ رقم الشعبة هنا
                    $gradeTeacher->save();
                }
            }
        }

        // 2️⃣ ثانياً: حفظ الصفوف العامة (التي تم اختيارها مباشرة لأنها بدون شعب)
        if ($request->has('grades')) {
            foreach ($request->input('grades') as $gradeId) {
                $gradeTeacher = new Grade_teacher();
                $gradeTeacher->teacher_id = $teacher->id;
                $gradeTeacher->grade_id   = (int) $gradeId;
                $gradeTeacher->section_id = null; // 🟢 لا توجد شعبة لأن الصف عام
                $gradeTeacher->save();
            }
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
        $request->validate([
            'full_name'    => 'required|string|max:150',
            'phone_number' => 'required|string|max:20',
            'subjects'      => 'required|array',
            'role_id'      => 'required|exists:roles,id',
        ]);

        $teacher->full_name    = $request->input('full_name');
        $teacher->phone_number = $request->input('phone_number');
        $teacher->role_id      = $request->input('role_id');
        $teacher->save();

        // 2. تحديث المواد الموكلة (حذف القديم وإضافة الجديد لمنع التكرار)
        // ملاحظة: إذا كنت تستخدم علاقات Laravel الرسمية (BelongsToMany) فالأفضل استخدام sync هكذا:
        // $teacher->subjects()->sync($request->input('subjects'));
        // ولكن بناءً على طريقتك الحالية بالـ Model اليدوي:
        Subject_teacher::where('teacher_id', $teacher->id)->delete();
        foreach ($request->input('subjects') as $subjectId) {
            $subjectTeacher = new Subject_teacher();
            $subjectTeacher->subject_id = $subjectId;
            $subjectTeacher->teacher_id = $teacher->id;
            $subjectTeacher->save();
        }
        // 3. تحديث أو تعديل حساب المستخدم (دون إنشاء حساب مكرر)
        $user = User::find($teacher->id); // البحث عن الحساب الحالي
        if (!$user) {
            $user = new User(); // إذا لم يكن له حساب، ينشئ واحد جديد
            $user->id = $teacher->id;
        }
        $user->name    = $teacher->full_name;
        $user->password = Hash::make($teacher->id);
        $user->role_id  = $request->input('role_id');
        $user->save();
        // 4. تحديث الصفوف والشعب (تنظيف السجلات القديمة أولاً)
        Grade_teacher::where('teacher_id', $teacher->id)->delete();

        // 🟢 أولاً: حفظ الصفوف والشعب (الشعب التي تحتوي على section_id)
        if ($request->has('sections')) {
            foreach ($request->input('sections') as $sectionId) {
                $section = section::find($sectionId);

                if ($section) {
                    $gradeTeacher = new Grade_teacher();
                    $gradeTeacher->teacher_id = $teacher->id;
                    $gradeTeacher->grade_id   = $section->grade_id;
                    $gradeTeacher->section_id = (int) $sectionId;
                    $gradeTeacher->save();
                }
            }
        }

        // 🟢 ثانياً: حفظ الصفوف العامة (التي تم اختيارها مباشرة لأنها بدون شعب)
        if ($request->has('grades')) {
            foreach ($request->input('grades') as $gradeId) {
                $gradeTeacher = new Grade_teacher();
                $gradeTeacher->teacher_id = $teacher->id;
                $gradeTeacher->grade_id   = (int) $gradeId;
                $gradeTeacher->section_id = null;
                $gradeTeacher->save();
            }
        }
        return redirect()->back()->with('success', 'تم تحديث بيانات المعلم بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return redirect()->back()->with('error', 'تم حذف الموظف');
    }
}
