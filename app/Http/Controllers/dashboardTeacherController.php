<?php

namespace App\Http\Controllers;

use App\Models\Assignment_submission;
use App\Models\Exam;
use App\Models\Teacher;
use Illuminate\Http\Request;

class dashboardTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teacher::where('id', auth()->id())->first();
        // نستخدم withCount لجلب عدد الطلاب لكل صف يدرسه المعلم
        $studentCount = $teacher->grades()
            ->withCount('students') // نحسب عدد الطلاب في كل صف
            ->get()                 // نحصل على الصفوف
            ->sum('students_count'); // نجمع الأعداد من كل الصفوف

        $assignmentUncorrection = Assignment_submission::where('status', 'uncorrection')->get();
        $examPublished = Exam::where('status', 'Published')->get();

        $gradesTeacher = Teacher::with(['subjects', 'grades', 'sections'])->where('id', auth()->id())->first();

        return response()->view('teacher.control_panel', [
            'studentCount' => $studentCount,
            'assignmentUncorrection' => $assignmentUncorrection,
            'examPublished' => $examPublished,
            'gradesTeacher' => $gradesTeacher,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
