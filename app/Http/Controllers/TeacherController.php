<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use App\Models\Teacher;
use App\Models\TeacherAcademicLevel;
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
        $teachers = Teacher::with(['academicLevels', 'role'])->get();
        $roles = RolePermission::all();
        return view('admin.teachers', ['teachers' => $teachers, 'roles' => $roles]);
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
            'subject'      => 'required|string|max:100',
            'role_id'      => 'required|exists:role_permissions,id',
        ]);

        // اطلب من لارافيل فحص الجدول بالكامل حتى المحذوفين مؤقتاً
        $lastTeacher = Teacher::withTrashed()->orderBy('id', 'desc')->first();

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
        $teacher->subject      = $request->input('subject');
        $teacher->role_id      = $request->input('role_id');
        $teacher->save();

        foreach ($request->input('sections', []) as $section) {
            [$academicLevel, $sectionName] = explode('|', $section);

            $teacherAcademicLevel = new TeacherAcademicLevel();
            $teacherAcademicLevel->teacher_id    = $teacher->id;
            $teacherAcademicLevel->academic_level = $academicLevel;
            $teacherAcademicLevel->section_name  = $sectionName;
            $teacherAcademicLevel->save();
        }

        // إنشاء حساب المستخدم
        $user = new User();
        $user->id       = $teacher->id;
        $user->name     = $teacher->full_name;
        $user->password = Hash::make($teacher->id);
        $user->role     = 'teacher';
        $user->save();

        return redirect()->back()->with('success', 'تم إضافة المعلم بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher, User $user, TeacherAcademicLevel $teacherAcademicLevel)
    {
        // 1. التحقق من البيانات (تأكد أن حقل الـ subject ممرر من الفورم)
        $request->validate([
            'full_name'    => 'required|string|max:150',
            'phone_number' => 'required|string|max:20',
            'subject'      => 'required|string|max:100',
            'role_id'      => 'required|exists:role_permissions,id',
        ]);

        // 2. تحديث بيانات المعلم الحالي بنجاح
        $teacher->full_name    = $request->input('full_name');
        $teacher->phone_number = $request->input('phone_number');
        $teacher->subject      = $request->input('subject');
        $teacher->role_id      = $request->input('role_id');
        $teacher->save();

        // 3. تحديث الأقسام (نحذف الأقسام القديمة للمعلم أولاً لتجنب التكرار)
        $teacherAcademicLevel->where('teacher_id', $teacher->id)->delete();

        foreach ($request->input('sections', []) as $section) {
            if (str_contains($section, '|')) {
                [$academicLevel, $sectionName] = explode('|', $section);

                // نستخدم كائن جديد هنا داخل اللوب لكل قسم لكي لا يتم تعديل نفس السجل مراراً
                $newSection = new TeacherAcademicLevel();
                $newSection->teacher_id    = $teacher->id;
                $newSection->academic_level = $academicLevel;
                $newSection->section_name  = $sectionName;
                $newSection->save();
            }
        }

        // 4. تحديث حساب المستخدم (هنا حل مشكلة Duplicate Entry)
        // نبحث عن المستخدم الحالي المرتبط بالمعلم حتى يقوم بعمل Update بدلاً من Insert
        $existingUser = $user->find($teacher->id);

        if ($existingUser) {
            // إذا كان المستخدم موجوداً، نحدث بياناته
            $existingUser->name = $teacher->full_name;
            // يفضل عدم تعديل الباسورد في التعديل العادي لكي لا يفقد المعلم حسابه
            $existingUser->save();
        } else {
            // في حال لم يكن له حساب سابقاً لأي سبب، ننشئه له
            $user->id       = $teacher->id;
            $user->name     = $teacher->full_name;
            $user->password = Hash::make($teacher->id);
            $user->role     = 'teacher';
            $user->save();
        }

        return redirect()->back()->with('success', 'تم تحديث بيانات المعلم بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        // الحصول على الـ id الحقيقي للمعلم لقطع الشك باليقين
        $teacherId = $teacher->getKey();

        // 1. حذف الأقسام الأكاديمية التابعة للمعلم
        TeacherAcademicLevel::where('teacher_id', $teacherId)->delete();

        // 2. حذف حساب المستخدم المرتبط به
        User::where('id', $teacherId)->delete();

        // 3. حذف المعلم نفسه
        $teacher->delete();

        return redirect()->back()->with('success', 'تم حذف المعلم وجميع البيانات المرتبطة به بنجاح!');
    }
}
