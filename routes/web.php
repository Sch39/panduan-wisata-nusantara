<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => redirect()->route('Home', ['locale' => App::currentLocale()]));

Route::prefix('{locale}')->where(['locale' => '[a-zA-Z]{2}'])->group(function () {
    Route::get('', fn () => redirect()->route(Route::getRoutes()->match(Request::create(URL::previous()))->getName()) ?? 'Home');

    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('Home');

    Route::get('/dashboard', function () {
        return Inertia::render('dashboard/index');
    })->name('Home');
});
