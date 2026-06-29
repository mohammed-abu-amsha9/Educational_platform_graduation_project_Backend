<?php

namespace App\Http\Controllers;

use App\Models\RolePermission;
use Illuminate\Http\Request;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = RolePermission::all();

        return view('admin.role_permistions', ['roles' => $roles]);
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
            'role_name' => 'required|string|max:255',
        ]);

        $rolePermission = new RolePermission();

        $rolePermission->role_name = $request->input('role_name');
        $rolePermission->can_manage_attendance = $request->boolean('can_manage_attendance');
        $rolePermission->can_upload_files =  $request->boolean('can_upload_files');
        $rolePermission->can_create_exams = $request->boolean('can_create_exams');
        $rolePermission->can_edit_grades =    $request->boolean('can_edit_grades');
        $rolePermission->can_reply_messages = $request->boolean('can_reply_messages');

        $rolePermission->save();
        // 4. إعادة التوجيه إلى الصفحة السابقة مع رسالة نجاح للمحاسب
        return redirect()->back()->with('success', 'تم تسجيل الدور بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RolePermission $role)
    {
        $request->validate([
            'role_name' => 'required|string|max:255',
        ]);
        
        $role->role_name = $request->input('role_name');
        $role->can_manage_attendance = $request->has('can_manage_attendance') ? 1 : 0;
        $role->can_upload_files      = $request->has('can_upload_files') ? 1 : 0;
        $role->can_create_exams      = $request->has('can_create_exams') ? 1 : 0;
        $role->can_edit_grades       = $request->has('can_edit_grades') ? 1 : 0;
        $role->can_reply_messages    = $request->has('can_reply_messages') ? 1 : 0;


        $role->save();
        // 4. إعادة التوجيه إلى الصفحة السابقة مع رسالة نجاح للمحاسب
        return redirect()->back()->with('success', 'تم تعديل الدور بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolePermission $rolePermission)
    {
        //
    }
}
