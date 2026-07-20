<?php

namespace App\Http\Controllers;

use App\Models\fee;
use App\Models\Student;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentFee = fee::with('student')->get();
        $students = Student::with('grade')->get();

        // حساب إجمالي المدفوع
        $totalPaid = $studentFee->sum('paid_amount');

        // // فرز وتجميع إجمالي المبالغ المدفوعة تلقائياً حسب وسيلة الدفع (نقداً، بنك، محفظة) مع تأمين القيم الغائبة بـ 0
        $paymentMethods = $studentFee
            ->whereNotNull('payment_method')
            ->groupBy('payment_method')
            ->map(fn($group) => $group->sum('paid_amount'));

        $cashAmount    = $paymentMethods['نقداً'] ?? 0;
        $bankAmount    = $paymentMethods['تحويل بنكي'] ?? 0;
        $walletAmount  = $paymentMethods['محفظة إلكترونية'] ?? 0;

        return view('admin.fees', [
            'data'         => $studentFee,
            'students'     => $students,
            'totalPaid'    => $totalPaid,
            'cashAmount'   => $cashAmount,
            'bankAmount'   => $bankAmount,
            'walletAmount' => $walletAmount,
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
        // 1. التحقق من البيانات القادمة من الفورم
        $validated = $request->validate([
            'student_id'     => 'required|integer|exists:students,id',
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

        $StudentMonthlyFee = new fee();

        // إسناد رقم الهوية كمعرف أساسي للـ id
        $StudentMonthlyFee->student_id = $request->input('student_id');
        $StudentMonthlyFee->billing_month = $request->input('billing_month');
        $StudentMonthlyFee->monthly_amount = $monthly_amount;
        $StudentMonthlyFee->paid_amount = $paid_amount;
        $StudentMonthlyFee->payment_method = $request->input('payment_method');
        $StudentMonthlyFee->notes = $request->input('notes');
        $StudentMonthlyFee->save();
        // 4. إعادة التوجيه إلى الصفحة السابقة مع رسالة نجاح للمحاسب
        return redirect()->back()->with('success', 'تم تسجيل الدفعة المالية للطالب بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(fee $fee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(fee $fee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, fee $fee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fee $fee)
    {
        //
    }
}
