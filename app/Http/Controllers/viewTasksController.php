<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use Illuminate\Http\Request;

class viewTasksController extends Controller
{
    public function Grading_and_monitoring_assignments()
    {
        $teacherId = 1;
        // جلب واجبات المعلم مع عدّ التسليمات المرتبطة بها
        $assignments = Assignment::where('teacher_id', $teacherId)
            ->withCount('submissions')
            ->get();
        return view('teacher.gradingAndMonitoringAssignments', ['assignments' => $assignments]);
    }

    public function studentsListView()
    {
        $teacherId = 1;
        // جلب كل التسليمات التابعة لواجبات المعلم المسجل دخوله حالياً
        $submissions = AssignmentSubmission::whereHas('assignment', function ($query) use ($teacherId) {
            $query->where('teacher_id', $teacherId);
        })->with(['assignment', 'student'])->get(); // جلب بيانات الواجب والطالب مع التسليم
        return view('teacher.studentsListView', ['submissions' => $submissions]);
    }

    public function reviewAndCorrection($id)
    {
        // جلب بيانات التسليم مع بيانات الطالب والواجب
        $submission = AssignmentSubmission::with(['student', 'assignment'])->findOrFail($id);
        return view('teacher.reviewAndCorrection', ['submission' => $submission]);
    }
}
