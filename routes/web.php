<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect()->route('Home', ['locale' => App::currentLocale()]));

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {

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
    Route::get('email/confirmation', fn () => Inertia::render('Auth/VerifyEmail', ['userEmail' => auth()->user()->email]))->middleware(['auth', 'ensure.email.not.verified'])->name('verification.notice');


    Route::middleware(['auth',])->group(function () {
        Route::middleware('verified')->group(function () {
            Route::get('/dashboard', function () {
                return Inertia::render('dashboard/index');
            })->name('Dashboard');
        });

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});


Route::get('/email/confirmation/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return to_route('Dashboard');
})->middleware(['auth', 'ensure.email.not.verified', 'signed'])->name('verification.verify');

Route::post('email/confirmation-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'success');
})->middleware(['auth', 'ensure.email.not.verified', 'throttle:2,1'])->name('verification.send');


Route::fallback(function () {
    return Inertia::render('Error/404', [
        'home' => route('Home'),
    ]);
});
