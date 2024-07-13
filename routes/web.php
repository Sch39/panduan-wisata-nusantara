<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect()->route('Home', ['locale' => App::currentLocale()]));

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    Route::get('', fn () => redirect()->route(Route::getRoutes()->match(Request::create(URL::previous()))->getName()) ?? 'Home');

    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('Home');

    Route::middleware(['guest'])->group(function () {
        // Start Auth
        Route::get('/login', [AuthController::class, 'login'])->name('Auth.Login');
        Route::post('/login', [AuthController::class, 'authenticate'])->name('Auth.authenticate');

        Route::get('/register', [AuthController::class, 'register'])->name('Auth.register');
        Route::post('/register', [AuthController::class, 'store'])->name('Auth.store');

        Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('Auth.password.request');
        Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('Auth.password.email');
        // End Auth
    });

    Route::get('/assets-credit', fn () => Inertia::render('AssetsCredit'))->name('assets-credit');


    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('dashboard/index');
        })->name('Dashboard');

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
