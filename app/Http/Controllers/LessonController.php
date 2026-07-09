<?php

namespace App\Http\Controllers;

use App\Models\grade_teacher;
use App\Models\lesson;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId =  1;

        $lessons = lesson::with('subject')->get();
        // جلب المواد الفريدة التي يدرسها هذا المعلم
        $teacher = teacher::with(['subjects.grade', 'grades.sections'])->find($teacherId);

        // جلب الصفوف الدراسية الموكلة لهذا المعلم
        // 3. جلب المواد الفريدة والصفوف الموكلة له
        $teacherSubjects = $teacher->subjects;
        $teacherGrades   = $teacher->grades;

        // 4. تمرير البيانات الصحيحة إلى صفحة الـ Blade
        return view('teacher.lessons', [
            'lessons' => $lessons,
            'teacherSubjects' => $teacherSubjects, // 🟢 تم إصلاح الاسم هنا
            'teacherGrades'   => $teacherGrades
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
        // 1. التحقق من صحة مدخلات الدرس
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'grades'     => 'required|array',
            'grades.*'   => 'exists:grades,id',
            'title'      => 'required|string|max:255',
            'file_type'  => 'required|in:video,pdf,link',
            'file'       => 'nullable', // جعلناه nullable مرن لأن المعلم قد يضع رابطًا أو يرفع ملفًا
        ]);

        // تثبيت معرف المعلم الحالي (مثال ثابت كما أعددته في الـ index)
        $teacherId = 1;

        // 2. معالجة الملف (إذا رفع ملفًا أو إذا وضع رابطًا خارجيًا)
        $fileUrl = null;

        if ($request->hasFile('file')) {
            // إذا قام برفع ملف حقيقي (فيديو أو PDF) نقوم بتخزينه
            $fileUrl = $request->file('file')->store('lessons', 'public');
        } elseif ($request->filled('file')) {
            // 💡 لمسة إضافية: إذا كان نوع الملف "رابط خارجي" وقام بكتابة الرابط في نفس الحقل
            $fileUrl = $request->input('file');
        }

        // 3. إنشاء كائن المحاضرة الأساسي وحفظه
        $lesson = new Lesson();
        $lesson->teacher_id = $teacherId;
        $lesson->subject_id = $request->input('subject_id');
        $lesson->title      = $request->input('title');
        $lesson->file_type  = $request->input('file_type');
        $lesson->file_url   = $fileUrl;
        $lesson->save();



        return redirect()->back()->with('success', 'تم نشر الدرس وبثه لكافة الصفوف المحددة بنجاح! 🚀');
    }

    /**
     * Display the specified resource.
     */
    public function show(lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        // 3. حذف ملف الشرح أو الفيديو من الـ Storage (إذا كان مخزناً محلياً) لتوفر مساحة
        if ($lesson->file_url && Storage::disk('public')->exists($lesson->file_url)) {
            Storage::disk('public')->delete($lesson->file_url);
        }

        // 4. حذف الدرس نفسه
        $lesson->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف الدرس وكافة الصفوف المرتبطة به بنجاح');
    }
}
