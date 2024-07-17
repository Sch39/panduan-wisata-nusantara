<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate', 'reCAPTCHA validation failed. Please try again.');

        Password::defaults(function () {
            return Password::min(8)
                ->mixedCase()
                ->uncompromised()
                ->numbers()
                ->symbols();
        });
    }
}
