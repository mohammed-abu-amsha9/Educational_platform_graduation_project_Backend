<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. تأكد أن المستخدم مسجل دخول
        if (!Auth::check()) {
            return redirect('/login');
        }
        // 2. جلب المستخدم الحالي
        $user = Auth::user();
        // 3. التحقق من أن الـ role_id الخاص بالمستخدم موجود ضمن الأدوار المسموح لها
        // ملاحظة: أنت ترسل الـ ID في المسار، لذا سنقارن بـ role_id
        if (in_array($user->role_id, $roles)) {
            return $next($request);
        }

        // 4. إذا لم يكن لديه صلاحية، أرسله لصفحة الخطأ أو لوحة تحكمه الخاصة
        return abort(403, 'ليس لديك صلاحية للوصول إلى هذه اللوحة.');
    }
}
