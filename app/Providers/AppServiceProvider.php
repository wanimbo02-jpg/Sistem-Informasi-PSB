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
        // Custom validation messages - semua error menjadi satu pesan yang sama
        $this->app->validator->replacer('*', function ($message, $attribute, $rule, $parameters) {
            return 'silahkan masukkan nisn anda dengan benar';
        });
    }
}
