<?php

namespace App\Http\Controllers;

use App\Models\grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = grade::all();
        return response()->view('admin.classes', ['grades' => $grades]);
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
        $request->validate([
            'grade_name' => 'required|string'
        ]);

        $grade = new grade();
        $grade->name = $request->input('grade_name');
        $grade->save();
        return redirect()->back()->with('success', 'تم إضافة صف جديد!');
    }

    /**
     * Display the specified resource.
     */
    public function show(grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, grade $grade)
    {
        $request->validate([
            'grade_name' => 'required|string'
        ]);

        $grade->name = $request->input('grade_name');
        $grade->save();
        return redirect()->back()->with('success', 'تم تحديث بيانات الصف !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        // 🟢 خطوة إضافية: حذف جميع الشعب المرتبطة بهذا الصف أولاً
        $grade->sections()->delete(); // تأكد أن لديك علاقة باسم sections() في موديل Grade
        // حذف الصف نفسه
        $grade->delete();
        return redirect()->back()->with('success', 'تم حذف الصف والشعب التابعة له بنجاح');
    }
}
