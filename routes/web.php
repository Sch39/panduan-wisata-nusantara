<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarbonCalculatorController;
use App\Http\Controllers\DestinationDetailController;
use App\Http\Controllers\DestinationListController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Models\DestinationDetail;
use App\Models\Province;
use App\Models\Regency;
use App\Models\TravelInspiration;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect()->route('Home', ['locale' => App::currentLocale()]));

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])
    ->group(function () {
        // Error
        Route::get('/error/404', function () {
            return Inertia::render('Error/404', [
                'home' => route('Home'),
            ]);
        })->name('Error.404');
        // Error End

        Route::get('help', fn () => Inertia::render('Help'))->name('Help');

        Route::get('/', function ($locale) {
            $regency_code = "01";

            $destinations = DestinationDetail::where('language_code', $locale)
                ->with(['destination:id,slug', 'regency', 'destination.rating:id,destination_id,avg_rating', 'regency.province' => function ($q) use ($locale) {
                    $q->where('language_code', $locale);
                }])
                ->whereHas('regency', function ($query) use ($regency_code) {
                    $query->where('code', $regency_code);
                })
                ->take(6)
                ->get();

            return Inertia::render('Home', [
                'destination_slider' => $destinations
            ]);
        })->name('Home');

        Route::get('/assets-credit', fn () => Inertia::render('AssetsCredit'))->name('assets-credit');

        Route::get('/destinations/{postal_code}', [DestinationListController::class, 'show'])->name('Destination.list');

        Route::get('/tour/{slug}', [DestinationDetailController::class, 'show'])->name('Destination.detail');

        Route::get('/travel-inspirations', function ($locale) {
            $travelInspirations = TravelInspiration::where('language_code', $locale)
                ->select(['id', 'language_code', 'image_url', 'travel_inspiration_slug_id', 'title'])
                ->with('slug:id,slug')
                ->paginate(10);

            // return $travelInspirations;
            return Inertia::render('TravelInspirations/TravelInspirationsList', [
                'travel_inspirations_pagination' => $travelInspirations,
            ]);
        });

        Route::get('/travel-inspirations/{slug}', function ($locale, $slug) {
            $travelInspirationsDetail = TravelInspiration::where('language_code', $locale)
                ->whereHas('slug', function ($q) use ($slug) {
                    $q->where('slug', $slug);
                })
                ->with('destination:id,slug')
                ->first();

            if (!$travelInspirationsDetail) {
                return to_route('Error.404');
            }
            return Inertia::render('TravelInspirations/TravelInspirationsDetail', [
                'travel_inspirations_detail' => $travelInspirationsDetail,
            ]);
        });


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

            // Route::get('/destinations', function () {
            //     $destinationProvinces = Cache::remember('destination_provinces', 30, function () {
            //         $data = DestinationDetail::select('id', 'language_code', 'regency_id')
            //             ->where('language_code', App::currentLocale())
            //             ->with(['regency:id,provinces_code'])
            //             ->get();
            //         $provincesCode = $data->unique('regency.provinces_code')->pluck('regency.provinces_code')->toArray();

            //         $provinces = Province::whereIn('code', $provincesCode)->orderBy('name', 'asc')->get();
            //         return $provinces;
            //     });

            //     return Inertia::render('Provinces', [
            //         'provinces' => $destinationProvinces->filter(fn ($item) => $item['language_code'] === App::currentLocale())->values(),
            //     ]);
            // });

            // Route::get('/destinations/{provinces_code}', function ($locale, $provinces_code) {

            //     $regencies = Cache::remember('destination_regencies', 30, function () use ($provinces_code) {
            //         $data = DestinationDetail::select('id', 'language_code', 'regency_id')
            //             ->with(['regency'])
            //             ->get();
            //         $regencies = $data->where('regency.provinces_code', $provinces_code)->unique('regency_id')->pluck('regency');

            //         return $regencies;
            //     });

            //     if ($regencies->isEmpty()) {
            //         return to_route('Error.404');
            //     }

            //     return Inertia::render(
            //         'Regencies',
            //         [
            //             'provinces_code' => $provinces_code,
            //             'regencies' => $regencies->filter(fn ($item) => $item['language_code'] === App::currentLocale())->values(),
            //         ]
            //     );
            // });
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
                    return to_route('Carbon.calculator');
                    // return Inertia::render('Dashboard/Dashboard');
                })->name('Dashboard');

                Route::get('/saved-destinations', fn () => Inertia::render('Dashboard/SavedDestinations'))->name('Destinations.saved');

                //Carbon Calculator
                Route::get('/carbon-calculator', [CarbonCalculatorController::class, 'show'])->name('Carbon.calculator');

                // Rating/vote
                Route::post('/votes', [RatingController::class, 'store'])->name('Rating.add');
                Route::delete('/votes/{id}', [RatingController::class, 'destroy'])->name('Rating.delete');
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
