<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        // إذا كان التطبيق ليس في البيئة المحلية (أي مرفوع أونلاين)، اجبر الـ HTTPS
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }
        RateLimiter::for('login', function (Request $request) {
            // يسمح بـ 5 محاولات تسجيل دخول فقط في الدقيقة الواحدة
            return Limit::perMinute(5)->by($request->ip());
        });
    }
}
