<?php

declare(strict_types = 1);

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Source - https://stackoverflow.com/a/77918619
// Posted by Rinaldi Pratama
// Retrieved 2026-06-30, License - CC BY-SA 4.0

        if (env(key: 'APP_ENV') === 'local' && request()->server(key: 'HTTP_X_FORWARDED_PROTO') === 'https') {
            URL::forceScheme(scheme: 'https');
        }

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! app()->isProduction());
        Carbon::setLocale(config('app.locale')); // usa o locale do Laravel
        date_default_timezone_set('America/Sao_Paulo');
$userAgent = request()->userAgent();
        $isMobile = (bool) preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i', $userAgent);

        View::share('isMobile', $isMobile);
    }
}
