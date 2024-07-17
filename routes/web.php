<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect()->route('Home', ['locale' => App::currentLocale()]));

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])
    ->group(function () {

        Route::get('/', function () {
            return Inertia::render('Home');
        })->name('Home');

        Route::get('/assets-credit', fn () => Inertia::render('AssetsCredit'))->name('assets-credit');

        Route::middleware(['guest'])->group(function () {
            // Start Auth
            Route::get('/login', [AuthController::class, 'login'])->name('Auth.login');
            Route::post('/login', [AuthController::class, 'authenticate'])->name('Auth.authenticate');

            Route::get('/register', [AuthController::class, 'register'])->name('Auth.register');
            Route::post('/register', [AuthController::class, 'store'])->name('Auth.store');

            Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('Auth.password.request');

            Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');

            Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('Auth.password.email');


            Route::post('/reset-password', [ForgotPasswordController::class, 'updatePassword'])->name('Auth.password.update');
            // End Auth
        });

        /**
         * Authenticated Group
         */
        Route::middleware(['auth'])->group(function () {
            // Email
            Route::get(
                'email/confirmation',
                function () {
                    return Inertia::render('Auth/VerifyEmail', [
                        'userEmail' => auth()->user()->email,
                    ]);
                }
            )->middleware(['ensure.email.not.verified'])->name('verification.notice');

            Route::post('email/confirmation-notification', function (Request $request) {
                $locale = $request->input('locale', App::currentLocale());

                $request->user()->sendEmailVerificationNotification();

                return back()->with('flash', ['message' => Lang::get('succesMessage.send_email', [], $locale), 'status' => 'success', 'status_code' => 202]);
            })->middleware(['ensure.email.not.verified', 'throttle:2,1'])->name('verification.send');

            Route::post('/logout', [AuthController::class, 'logout'])->name('Logout');


            /**
             * Verified Group
             */
            Route::middleware('verified')->group(function () {

                Route::get('/user/profile', [UserController::class, 'showProfile'])->name('User.show');
                Route::post('/user/profile', [UserController::class, 'updateProfile'])->name('User.update');

                Route::get('/dashboard', function () {
                    return to_route('Destinations.saved');
                    // return Inertia::render('Dashboard/Dashboard');
                })->name('Dashboard');

                Route::get('/saved-destinations', fn () => Inertia::render('Dashboard/SavedDestinations'))->name('Destinations.saved');
            });
        });
    });


Route::get('/email/confirmation/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return to_route('Dashboard');
})->middleware(['auth', 'ensure.email.not.verified', 'signed'])->name('verification.verify');


Route::fallback(function () {
    return Inertia::render('Error/404', [
        'home' => route('Home'),
    ]);
});
