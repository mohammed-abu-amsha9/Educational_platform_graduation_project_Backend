<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // جلب جميع الطلاب من قاعدة البيانات
        $students = Student::filter($request->all())->get();

        // تمرير المتغير الفعلي باستخدام اسمه كقيمة للمفتاح 'data'
        return view('admin.students', ['data' => $students]);
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
        // 1. التحقق من البيانات المدخلة (Validation)
        $request->validate([
            'id' => 'required|numeric|unique:students,id', // التأكد من أن رقم هوية الطالب فريد وغير مكرر
            'full_name' => 'required|string|max:150',
            'academic_level' => 'required|string',
            'section_name' => 'required|string',
            'total_paid_amount' => 'required|string',
            'parent_id' => 'required|numeric',
            'parent_phone' => 'required|string|max:18',
            'parent_backup_phone' => 'nullable|string|max:18',
        ]);

        // 2. توليد رقم الطالب التسلسلي تلقائياً (student_code)
        // نأتي بآخر طالب تم تسجيله للحصول على الكود الخاص به
        $lastStudent = Student::orderBy('student_code', 'desc')->first();

        // preg_match => تبحث عن نمبط معين داخل النص
        if ($lastStudent && preg_match('/STU_(\d+)/', $lastStudent->student_code, $matches)) {
            // إذا وجدنا طالب سابق، نأخذ الرقم ونزيد عليه 1
            // intval => تحول الرقم المستخرج لرقم صحيح
            $nextNumber = intval($matches[1]) + 1;
        } else {
            // إذا كان هذا أول طالب في النظام
            $nextNumber = 1;
        }

        // تشكيل الكود الجديد ليصبح مثل STU_001, STU_002... إلخ
        // str_pad => تأخذ الرقم (مثلاً 1) وتجعل طوله 3 خانات بوضع أصفار على يساره
        $studentCode = 'STU_' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // 3. إنشاء طالب جديد وحفظ البيانات
        $student = new Student();

        // إسناد رقم الهوية كمعرف أساسي للـ id
        $student->id = $request->input('id');
        $student->full_name = $request->input('full_name');
        $student->student_code = $studentCode;
        $student->academic_level = $request->input('academic_level');
        $student->section_name = $request->input('section_name');
        $student->total_paid_amount = $request->input('total_paid_amount');
        $student->parent_id = $request->input('parent_id');
        $student->parent_phone = $request->input('parent_phone');
        $student->parent_backup_phone = $request->input('parent_backup_phone') ?? '';

        // حقل account_status سيأخذ القيمة الافتراضية 'active' تلقائياً من الـ migration

        $student->save();

        // 4. إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم إضافة بيانات الطالب وتثبيته بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // تعديل بيانات الطالب الشخصية
    public function update(Request $request, Student $student)
    {
        // 1. التحقق من البيانات المدخلة (Validation)
        $request->validate([
            'id' => 'required|numeric', // التأكد من أن رقم هوية الطالب فريد وغير مكرر
            'full_name' => 'required|string|max:150',
            'parent_id' => 'required|numeric',
            'parent_phone' => 'required|string|max:18',
        ]);
        // إسناد رقم الهوية كمعرف أساسي للـ id
        $student->id = $request->input('id');
        $student->full_name = $request->input('full_name');
        $student->parent_id = $request->input('parent_id');
        $student->parent_phone = $request->input('parent_phone');
        $student->save();
        // 4. إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم تحديث بيانات الطالب بنجاح!');
    }

    // تعديل الصف والشعبة
    public function editClassStudent(Request $request, Student $student)
    {
        // 1. التحقق من البيانات المدخلة (Validation)
        $request->validate([
            'academic_level' => 'required|string',
            'section_name' => 'required|string',
        ]);
        $student->academic_level = $request->input('academic_level');
        $student->section_name = $request->input('section_name');
        $student->save();
        return redirect()->back()->with('success', 'تم تحديث بيانات الطالب بنجاح!');
    }

    // تعديل مبلغ الرسوم المطلوب
    public function editFeesStudent(Request $request, Student $student)
    {
        // 1. التحقق من البيانات المدخلة (Validation)
        $request->validate([
            'total_paid_amount' => 'required|string',
        ]);
        $student->total_paid_amount = $request->input('total_paid_amount');
        $student->save();
        return redirect()->back()->with('success', 'تم تحديث بيانات الطالب بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    // حذف الطالب ووضعه في الارشيف
    public function destroy( $id)
    {
        // العثور على الطالب وحذفه
        $student = Student::findOrFail($id);
        $student->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف الطالب بنجاح');

    }
}
