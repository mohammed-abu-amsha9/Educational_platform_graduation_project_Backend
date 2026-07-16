<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\assignment_submission;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;

class AssignmentSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::with(['subject', 'grade', 'section'])->get();
        // جلب تسليمات الطالب الحالي فقط
        $studentId = 1;
        $mySubmissions = AssignmentSubmission::where('student_id', $studentId)->get();
        return response()->view('student.tasks_and_duties', ['assignments' => $assignments, 'mySubmissions' => $mySubmissions]);
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
        // 1. رفع الملف
        $path = $request->file('file')->store('submissions', 'public');
        $studentId = 1;
        // 2. تخزين في قاعدة البيانات
        $assignment_submission = new AssignmentSubmission();
        $assignment_submission->assignment_id = $request->assignment_id;
        $assignment_submission->student_id = $studentId;
        $assignment_submission->submitted_file_url = $path;
        $assignment_submission->submitted_at = now();
        $assignment_submission->save();
        // 3. العودة للصفحة مع رسالة نجاح
        return redirect()->back()->with('success', 'تم تسليم المهمة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignmentSubmission $assignmentSubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignmentSubmission $assignmentSubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignmentSubmission $assignmentSubmission)
    {
        $request->validate([
            'mark' => 'required|numeric|min:0|max:10',
        ]);
        $assignmentSubmission->mark = $request->input('mark');
        $assignmentSubmission->status = 'correction'; // تغيير الحالة
        $assignmentSubmission->save();
        return redirect()->route('studentsListView')->with('success', 'تم رصد الدرجة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignmentSubmission $assignmentSubmission)
    {
        //
    }
}
