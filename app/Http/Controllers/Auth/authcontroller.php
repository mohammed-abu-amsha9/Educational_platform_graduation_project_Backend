<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authcontroller extends Controller
{
    public function showLoginForm()
    {

        return view('login'); // تأكد من وجود ملف الـ View
    }

    public function login(Request $request)
    {
        // 1. التحقق من البيانات
        $credentials = $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        // 2. محاولة تسجيل الدخول
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. التوجيه الديناميكي بناءً على الـ role_id[cite: 1]
            $user = Auth::user();

            return match ((int)$user->role_id) {
                1 => redirect()->route('dashboard.index'), // الأدمن[cite: 1]
                2 => redirect()->route('dashboardTeacher.index'), // المعلم[cite: 2]
                3 => redirect()->route('dashboardStudent.index'),   // الطالب [cite: 3]
                default => redirect('/'),
            };
        }

        // 4. في حال فشل الدخول
        return back()->withErrors(['id' => 'رقم الهوية أو كلمة المرور غير صحيحة.']);
    }

    public function logout(Request $request)
    {
        Auth::logout(); // تسجيل خروج المستخدم

        $request->session()->invalidate(); // إلغاء الجلسة
        $request->session()->regenerateToken(); // تجديد الـ Token للحماية

        return redirect('/'); // التوجيه لصفحة تسجيل الدخول
    }
}
