<?php

namespace App\Http\Controllers;

use App\Models\fee;
use App\Models\grade;
use App\Models\student;
use App\Models\subject;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalStudents = \App\Models\Student::withTrashed()->count(); // إجمالي الطلاب
        $totalStudentsActive = student::where('account_status', 'active')->count(); // إجمالي الطلاب النشيطين
        $activeTeachers = \App\Models\Teacher::withTrashed()->count(); // إجمالي المعلمين (يمكنك تصفيتها حسب النشطين)
        // نجيب إجمالي المبالغ المطلوبة بدون تكرار حسب الطالب والشهر
        $totalRequired = student::sum('total_paid_amount'); // مجموع الرصيد من الطلاب
        $totalPaid = Fee::sum('paid_amount'); // مجموع المدفوع من الطلاب
        $totalGrade = \App\Models\Student::withTrashed()->count();
        // المتبقي العام
        $totalRemaining = $totalRequired - $totalPaid;
        // عدد الطلاب الذين سددوا بالكامل
        $totalFullyPaid = Student::whereIn('id', function ($query) {
            $query->select('student_id')
                ->from('fees')
                ->groupBy('student_id')
                ->havingRaw('SUM(paid_amount) >= (SELECT total_paid_amount FROM students WHERE students.id = fees.student_id)');
        })->count();

        // جلب الصفوف مع عدد طلابها
        $grades = grade::withCount('students')->get()->map(function ($classroom) {
            // السعة القصوى المحددة في الداتابيز، أو افتراضياً 20 لو مش موجود العمود
            $maxCapacity = $classroom->max_capacity ?? 40;

            // حساب النسبة المئوية
            $percentage = $maxCapacity > 0
                ? round(($classroom->students_count / $maxCapacity) * 100)
                : 0;

            // حط النسبة داخل الموديل بشكل مؤقت لاستخدامها في الـ View
            $classroom->percentage = $percentage;
            $classroom->is_full = $percentage >= 100;

            return $classroom;
        });

        $totalSubjects = subject::count();

        return response()->view('admin.control_panel', [
            'totalStudents' => $totalStudents,
            'totalStudentsActive' => $totalStudentsActive,
            'activeTeachers' => $activeTeachers,
            'totalPaid' => $totalPaid,
            'totalRemaining' => $totalRemaining,
            'totalFullyPaid' => $totalFullyPaid,
            'totalGrade' => $totalGrade,
            'grades' => $grades,
            'totalSubjects' => $totalSubjects,
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
