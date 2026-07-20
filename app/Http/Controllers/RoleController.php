<?php

namespace App\Http\Controllers;

use App\Models\Permistion;
use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = role::with('permistions')->get();
        $permistions = Permistion::all();
        return response()->view('admin.roles', ['roles' => $roles, 'permistions' => $permistions]);
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
            'role_name' => 'required|string',
            'permistions'   => 'required|array', // التأكد أنها مصفوفة
            'permistions.*' => 'exists:permistions,id' // التحقق من أن كل ID موجود بالفعل في جدول الصلاحيات
        ]);

        $role = new role();
        $role->role_name = $request->input('role_name');
        $role->save();
        // 3. ربط الصلاحيات المحددة بالدور في الجدول الوسيط (Pivot Table)
        $role->permistions()->attach($request->input('permistions'));
        return redirect()->back()->with('success', 'تم إضافة الدور بنجاح!');
    }

    /**
     * Display the specified resource.
     */
    public function show(role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 1. التحقق من البيانات القادمة من المودال
        $request->validate([
            'role_name'     => 'required|string|max:255',
            'permistions'   => 'required|array', // التأكد من اختيار صلاحية واحدة على الأقل
            'permistions.*' => 'exists:permistions,id' // التأكد من أن المعرفات حقيقية في قاعدة البيانات
        ]);

        // 2. جلب الدور المُراد تعديله بناءً على الـ ID
        $role = role::findOrFail($id);

        // 3. تحديث اسم الدور وحفظه
        $role->role_name = $request->input('role_name');
        $role->save();

        // 4. تحديث الصلاحيات في الجدول الوسيط (تزامن تلقائي لحذف الملغي وإضافة الجديد)
        $role->permistions()->sync($request->input('permistions'));

        // 5. العودة للخلف مع رسالة نجاح
        return redirect()->back()->with('success', 'تم تحديث الدور وتعديل صلاحياته بنجاح!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with('success', 'تم حذف الدور بنجاح');
    }
}
