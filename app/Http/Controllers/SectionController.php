<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with('grade')->get();
        $grades = Grade::all();
        return response()->view('admin.sections', ['sections' => $sections, 'grades' => $grades]);
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
            'section_name' => 'required|string',
            'grade_id' => 'required|exists:grades,id'
        ]);

        $section = new Section();
        $section->name = $request->input('section_name');
        $section->grade_id = $request->input('grade_id');
        $section->save();
        return redirect()->back()->with('success', 'تم اضافة الشعبة مع ربطها في صف بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, section $section)
    {
        $request->validate([
            'section_name' => 'required|string',
            'grade_id' => 'required|exists:grades,id'
        ]);

        $section->name = $request->input('section_name');
        $section->grade_id = $request->input('grade_id');
        $section->save();
        return redirect()->back()->with('success', 'تم تحديث بيانات الشعبة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();
        return redirect()->back()->with('success', 'تم حذف الشعبة بنجاح');
    }
}
