<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\section;
use App\Models\Teacher;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacherId = auth()->id();
        // 1. جلب المعلم مع المواد والصفوف والشعب (مع منع التكرار لاحقاً)
        $currentTeacher = Teacher::with(['subjects', 'grades.sections'])->find($teacherId);

        return response()->view('teacher.tasks_manage', [
            'currentTeacher' => $currentTeacher,
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
        // 1. التحقق من صحة البيانات القادمة من الفورم
        $request->validate([
            'title'    => 'required|string', // يحتوي على "grade_id|subject_id"
            'due_date'      => 'required|date',
            'description'  => 'required|string',
            'file'    => 'nullable',
            'total_mark'       => 'required|numeric',
        ]);

        // 2. تفكيك القيمة المدمجة (مثل: sub_1_sec_2 أو sub_1_grd_3)
        $assignmentValue = $request->input('section_id');
        $parts = explode('_', $assignmentValue);

        $subjectId = $parts[1]; // الرقم بعد sub
        $type = $parts[2];     // سواء كان sec أو grd
        $targetId = $parts[3]; // رقم الشعبة أو الصف

        // 3. حفظ البيانات في نموذج الواجب
        $assignment = new Assignment();
        $assignment->teacher_id =  auth()->id(); // يفضل استخدام auth()->id()
        $assignment->subject_id = $subjectId;

        if ($type === 'sec') {
            $assignment->section_id = $targetId;
            // جلب الصف التابع لهذه الشعبة (تحتاج علاقة في موديل Section)
            $assignment->grade_id = section::find($targetId)->grade_id;
        } else {
            $assignment->grade_id = $targetId;
            $assignment->section_id = null; // أو القيمة الافتراضية لديك
        }

        $assignment->title = $request->input('title');
        $assignment->due_date = $request->input('due_date');
        $assignment->description = $request->input('description');

        // معالجة الملف
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('assignments', 'public');
            $assignment->file = $path;
        }

        $assignment->total_mark = $request->input('total_mark');
        $assignment->save();

        return redirect()->back()->with('success', 'تم نشر الواجب بنجاح');
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
