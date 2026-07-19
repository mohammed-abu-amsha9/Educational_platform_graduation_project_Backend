<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            // التوجيه حسب الدور
            return match ($user->role) {
                1 => redirect()->route('dashboardStudent.index'), // الطالب[cite: 1]
                2 => redirect()->route('dashboardTeacher.index'), // المعلم[cite: 1]
                3 => redirect()->route('dashboard.index'),   // الأدمن[cite: 1]
                default => redirect('/'),
            };
        }

        return $next($request);
    }
}
