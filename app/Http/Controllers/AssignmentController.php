<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\grade;
use App\Models\lesson;
use App\Models\subject;
use App\Models\teacher;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = 1; // معرف المعلم المستهدف

        // 1. جلب الصفوف التي يحتوي جدولها على مواد يدرسها المعلم رقم 1
        $grades = grade::whereHas('subjects.teachers', function ($query) use ($teacherId) {
            $query->where('teachers.id', $teacherId);
        })->get();

        // 2. جلب المواد التي يدرسها المعلم رقم 1 فقط
        $subjects = subject::whereHas('teachers', function ($query) use ($teacherId) {
            $query->where('teachers.id', $teacherId);
        })->get();

        // 3. ا جلب الدروس التابعة للمواد التي يدرسها المعلم رقم 1 فقط
        // (عن طريق التأكد من أن المادة التابعة للدرس يدرسها المعلم رقم 1)
        $lessons = lesson::whereHas('subject.teachers', function ($query) use ($teacherId) {
            $query->where('teachers.id', $teacherId);
        })->get();

        // 4. تمرير القوائم الثلاث المصفاة بنجاح
        return view('teacher.tasks_manage', [
            'grades'   => $grades,
            'subjects' => $subjects,
            'lessons'  => $lessons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([
        'title'        => 'required|string|max:255',
        'lesson_id'    => 'required|exists:lessons,id',
        'deadline'     => 'required|date',
        'description'  => 'required|string',
        'file'         => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120', // حد أقصى 5 ميجا
        'total_mark'   => 'required|integer|min:1|max:100',
    ]);


    $filePath = null;
    if ($request->hasFile('file')) {
        // سيتم حفظ الملف في مجلد storage/app/public/assignments
        $filePath = $request->file('file')->store('assignments', 'public');
    }


    $assignment = new Assignment();

    $assignment->teacher_id = 1; 
    $assignment->lesson_id = $request->lesson_id;
    $assignment->title = $request->title;
    $assignment->deadline = $request->deadline;
    $assignment->description = $request->description;
    $assignment->file = $filePath; // تخزين مسار الملف الجديد المحفوظ وليس كائن الـ Request
    $assignment->total_mark = $request->total_mark;


    $assignment->save();


    return redirect()->back()->with('success', 'تم نشر وتكليف الطلاب بالواجب بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}