<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/welcolme', function () {
    return Inertia::render('Welcome');
})->name('welcolme');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('tracks')->name('tracks.')->group(function () {
    Route::get('/', [TrackController::class, 'index'])->name('index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
