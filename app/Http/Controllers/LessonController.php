<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonSection;
use App\Models\TeacherAcademicLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId =  1;

        // 2. جلب جميع الدروس المرفوعة من هذا المعلم مع الشعب المستهدفة
        $lessons = Lesson::with('sections')
            ->where('teacher_id', $teacherId)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. جلب الصفوف والشعب الموكلة للمعلم لتعبئة القوائم بـ فورم الإضافة
        $teacherClasses = TeacherAcademicLevel::where('teacher_id', $teacherId)->get();

        return view('teacher.lessons', [
            'lessons' => $lessons,
            'teacherClasses' => $teacherClasses
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
            'subject_name' => 'required|string',
            'sections'     => 'required|array|min:1', // مصفوفة الصفوف المحددة
            'title'        => 'required|string|max:255',
            'file_type'    => 'required|in:video,pdf,link',
            'file'         => 'nullable|file|max:61440', // حد أقصى 60 ميغابايت
        ]);

        // تثبيت معرف المعلم الحالي (مثال ثابت كما أعددته في الـ index)
        $teacherId = 1;

        // 2. معالجة رفع الملف المرفق وحفظ مساره
        $fileUrl = null;
        if ($request->hasFile('file')) {
            // سيتم تخزين الملف داخل مجلد نطلق عليه اسم lessons في الـ storage الخاص بك
            $fileUrl = $request->file('file')->store('lessons', 'public');
        }

        // 3. إنشاء كائن المحاضرة الأساسي وحفظه
        $lesson = new Lesson();
        $lesson->teacher_id   = $teacherId;
        $lesson->subject_name = $request->input('subject_name');
        $lesson->title        = $request->input('title');
        $lesson->file_type    = $request->input('file_type');
        $lesson->file_url    = $fileUrl;
        $lesson->save();

        // 4. ربط الدرس بأكثر من صف وشعبة دفعة واحدة في جدول الشعب الوسيط للدروس
        foreach ($request->input('sections') as $sectionData) {
            // تفكيك القيم المرسلة من الـ Checkboxes المفلترة (مثل: عاشر|أ)
            [$academicLevel, $sectionName] = explode('|', $sectionData);

            // نقوم بالحفظ في الجدول المرتبط بالدرس (مثال لاسم الموديل: LessonSection)
            $lessonSection = new LessonSection();
            $lessonSection->lesson_id      = $lesson->id;
            $lessonSection->academic_level = $academicLevel;
            $lessonSection->section_name   = $sectionName;
            $lessonSection->save();
        }

        return redirect()->back()->with('success', 'تم نشر الدرس وبثه لكافة الصفوف المحددة بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lesson $lesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lesson $lesson)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // العثور على الطالب وحذفه
        $lesson = Lesson::findOrFail($id);
        LessonSection::where('lesson_id', $lesson->id)->delete();

        // 3. حذف ملف الشرح أو الفيديو من الـ Storage (إذا كان مخزناً محلياً) لتوفر مساحة
        if ($lesson->file_path && Storage::disk('public')->exists($lesson->file_path)) {
            Storage::disk('public')->delete($lesson->file_path);
        }

        // 4. حذف الدرس نفسه
        $lesson->delete();

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم حذف الدرس وكافة الصفوف المرتبطة به بنجاح');
    }
}
