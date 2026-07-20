<?php

namespace App\Http\Controllers;

use App\Models\Permistion;
use Illuminate\Http\Request;

class PermistionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permistions = Permistion::all();
        return response()->view('admin.permistions', ['permistions' => $permistions]);
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
            'permistion_name' => 'required|string'
        ]);

        $permistion = new permistion();
        $permistion->permistion_name = $request->input('permistion_name');
        $permistion->save();
        return redirect()->back()->with('success', 'تم إضافة الصلاحية بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(permistion $permistion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(permistion $permistion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, permistion $permistion)
    {
        $request->validate([
            'permistion_name' => 'required|string'
        ]);

        $permistion->permistion_name = $request->input('permistion_name');
        $permistion->save();
        return redirect()->back()->with('success', 'تم تعديل الصلاحية بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permistion = permistion::findOrFail($id);
        $permistion->roles()->delete();
        $permistion->delete();
        return redirect()->back()->with('success', 'تم حذف الصلاحية والدور التابعة له بنجاح');
    }
}
