<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('grade')->get();
        $grades = Grade::all();
        return response()->view('admin.subjects', ['subjects' => $subjects, 'grades' => $grades]);
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
            'subject_name' => 'required|string',
            'grade_id' => 'required|exists:grades,id'
        ]);

        $subject = new Subject();
        $subject->name = $request->input('subject_name');
        $subject->grade_id = $request->input('grade_id');
        $subject->save();
        return redirect()->back()->with('success', 'تم اضافة المادة مع ربطها في صف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, subject $subject)
    {
        $request->validate([
            'subject_name' => 'required|string',
            'grade_id' => 'required|exists:grades,id'
        ]);

        $subject->name = $request->input('subject_name');
        $subject->grade_id = $request->input('grade_id');
        $subject->save();
        return redirect()->back()->with('success', 'تم تحديث بيانات المادة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->back()->with('success', 'تم حذف المادة بنجاح');
    }
}
