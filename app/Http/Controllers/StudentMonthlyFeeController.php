<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentMonthlyFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentMonthlyFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // جلب الطلاب مع حساب مجموع مدفوعاتهم الحالية لتغذية الجافاسكربت
        $currentMonth = date('m-Y'); // الشهر الحالي مثل 06-2026

        // جلب الطلاب مع حساب إجمالي ما دفعوه في جدول student_monthly_fees لهذا الشهر
        $student = Student::all();

        return view('admin.fees', ['students' => $student]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. التحقق من البيانات القادمة من الفورم
        $validated = $request->validate([
            'student_id'     => 'required|integer|exists:students,id',
            'academic_level' => 'required|string|max:50',
            'billing_month'  => 'required|string|max:20',
            'monthly_amount' => 'required|numeric|min:0',
            'paid_amount'    => 'required|numeric|min:0|max:' . $request->monthly_amount,
            'payment_method' => 'required|string|max:50',
            'notes'          => 'nullable|string',
        ]);

        // 2. معالجة البيانات الإضافية تلقائياً
        // بما أن الحساب التلقائي للمتبقي أفضل أن يتم برمجياً لأمان النظام:
        $monthly_amount = (float) $validated['monthly_amount'];
        $paid_amount    = (float) $validated['paid_amount'];

        $StudentMonthlyFee = new StudentMonthlyFee();

        // إسناد رقم الهوية كمعرف أساسي للـ id
        $StudentMonthlyFee->student_id = $request->input('student_id');
        $StudentMonthlyFee->academic_level = $request->input('academic_level');
        $StudentMonthlyFee->billing_month = $request->input('billing_month');
        $StudentMonthlyFee->monthly_amount = $monthly_amount;
        $StudentMonthlyFee->paid_amount = $paid_amount;
        $StudentMonthlyFee->payment_method = $request->input('payment_method');
        $StudentMonthlyFee->payment_date = now();
        $StudentMonthlyFee->notes = $request->input('notes');

        $StudentMonthlyFee->save();
        // 4. إعادة التوجيه إلى الصفحة السابقة مع رسالة نجاح للمحاسب
        return redirect()->back()->with('success', 'تم تسجيل الدفعة المالية للطالب بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentMonthlyFee $studentMonthlyFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentMonthlyFee $studentMonthlyFee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentMonthlyFee $studentMonthlyFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentMonthlyFee $studentMonthlyFee)
    {
        //
    }
}
