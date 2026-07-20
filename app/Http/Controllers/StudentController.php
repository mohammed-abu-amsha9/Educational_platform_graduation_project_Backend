<?php

namespace App\Http\Controllers;

use App\Models\grade;
use App\Models\role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // جلب جميع الطلاب من قاعدة البيانات
        $students = Student::filter($request->all())->with('grade')->get();

        // 2. جلب جميع الصفوف لعرضها في قائمة الـ Select
        $grades = grade::with('sections')->get();

        // 3. تمرير المتغيرين معاً إلى الـ View
        return view('admin.students', [
            'students' => $students,
            'grades'   => $grades // 👈 أضفنا الصفوف هنا
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
        // 1. التحقق من البيانات المدخلة (Validation)
        $request->validate([
            'full_name'       => 'required|string|max:255',
            'total_paid_amount'  => 'required|string',
            'parent_id'   => 'required|string',
            'parent_phone'   => 'required|string',
            'grade_id'   => 'required|exists:grades,id',   // التأكد من أن الصف موجود في جدول grades
            'section_id' => 'required|exists:sections,id', // التأكد من أن الشعبة موجودة في جدول sections
        ]);

        // 2. توليد رقم الطالب التسلسلي تلقائياً (student_code)
        // نأتي بآخر طالب تم تسجيله للحصول على الكود الخاص به
        $lastStudent = Student::withTrashed()->latest('created_at')->first();

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
        $studentCode = 'STU_' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // 1. 🟢 جلب دور الطالب تلقائياً من قاعدة البيانات بناءً على اسمه
        $studentRole = role::where('role_name', 'طالب')
            ->orWhere('role_name', 'student')
            ->first();

        // تأمين النظام في حال لم يكن الدّور منشأ مسبقاً في قاعدة البيانات
        if (!$studentRole) {
            return redirect()->back()->withErrors(['error' => 'دور الطالب غير معرف في النظام، يرجى إنشاؤه أولاً.']);
        }
        DB::transaction(function () use ($request, $studentCode, $studentRole) {
            // 3. إنشاء طالب جديد وحفظ البيانات
            $student = new Student();
            $student->id = $request->input('id');
            $student->full_name = $request->input('full_name');
            $student->student_code = $studentCode;
            $student->grade_id = $request->input('grade_id');
            $student->section_id = $request->input('section_id');
            $student->total_paid_amount = $request->input('total_paid_amount');
            $student->parent_id = $request->input('parent_id');
            $student->parent_phone = $request->input('parent_phone');
            $student->parent_backup_phone = $request->input('parent_backup_phone') ?? '';
            $student->save();
            // انشاء حساب طالب
            $user = new User();
            $user->id = $student->id;
            $user->name = $student->full_name;
            $user->password = Hash::make($request->input('id'));
            $user->role_id = $studentRole->id;
            $user->save();
        });
        return redirect()->back()->with('success', 'تم إضافة بيانات الطالب وتثبيته بنجاح!');
    }

    // تعديل الصف والشعبة
    public function editClassStudent(Request $request, Student $student)
    {
        // 1. التحقق من البيانات المدخلة (Validation)
        $request->validate([
            'grade_id'   => 'required|exists:grades,id',   // التأكد من أن الصف موجود فعلياً
            'section_id' => 'required|exists:sections,id', // التأكد من أن الشعبة موجودة فعلياً
        ]);

        // 💡 خطوة أمنية إضافية: التأكد من أن الشعبة المختارة تنتمي بالفعل للصف المختار
        $isSectionBelongsToGrade = \App\Models\Section::where('id', $request->section_id)
            ->where('grade_id', $request->grade_id)
            ->exists();

        if (!$isSectionBelongsToGrade) {
            return redirect()->back()->withErrors(['section_id' => 'الشعبة المختارة لا تنتمي لهذا الصف الدراسي!'])->withInput();
        }
        // 2. تحديث الحقول الرقمية الصحيحة في كائن الطالب
        $student->grade_id = $request->input('grade_id');
        $student->section_id = $request->input('section_id');
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
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        $request->validate([
            'full_name'       => 'required|string|max:255',
            'parent_id'   => 'required|string',
            'parent_phone'   => 'required|string',
        ]);
        $student->id = $request->input('id');
        $student->full_name = $request->input('full_name');
        $student->parent_id = $request->input('parent_id');
        $student->parent_phone = $request->input('parent_phone');
        $student->save();

        $user = User::find($student->id);
        if ($user) {
            $user->id = $student->id;
            $user->name = $student->full_name;
            $user->password = Hash::make($request->input('id'));
            $user->save();
        }
        return redirect()->back()->with('success', 'تم تحديث بيانات الطالب بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // العثور على الطالب وحذفه
        $student = Student::findOrFail($id);
        $student->account_status = 'no active';
        $student->save();
        $student->delete();

        // 3. 🟢 العثور على حساب المستخدم (User) المرتبط بالطالب وإيقافه
        $user = User::find($id); // لأن id الطالب هو نفسه id المستخدم
        if ($user) {
            $user->delete();
        }
        return redirect()->back()->with('success', 'تم حذف الطالب بنجاح');
    }
}
