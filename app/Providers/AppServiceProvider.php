<?php

namespace App\Providers;

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
        // Deteksi otomatis jika dijalankan lewat folder Laragon
        // Ini mengatasi semua masalah URL tanpa perlu pusing mikir .env atau cache
        $requestUri = $_SERVER['REQUEST_URI'] ?? '';
        if (strpos($requestUri, '/paramitra-app/public') === 0) {
            \Illuminate\Support\Facades\URL::forceRootUrl('http://localhost/paramitra-app/public');
        } elseif (config('app.url') !== 'http://localhost') {
            \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
        }
    }
}
