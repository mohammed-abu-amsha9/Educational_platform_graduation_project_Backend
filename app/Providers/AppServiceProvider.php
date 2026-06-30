<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
    }
}
